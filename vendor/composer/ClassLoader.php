<?php

/*
 * This file is part of Composer.
 *
 * (c) Nils Adermann <naderman@naderman.de>
 *     Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Composer\Autoload;

/**
 * ClassLoader implements a PSR-0, PSR-4 and classmap class loader.
 *
 *     $loader = new \Composer\Autoload\ClassLoader();
 *
 *     // register classes with namespaces
 *     $loader->add('Symfony\Component', __DIR__.'/component');
 *     $loader->add('Symfony',           __DIR__.'/framework');
 *
 *     // activate the autoloader
 *     $loader->register();
 *
 *     // to enable searching the include path (eg. for PEAR packages)
 *     $loader->setUseIncludePath(true);
 *
 * In this example, if you try to use a class in the Symfony\Component
 * namespace or one of its children (Symfony\Component\Console for instance),
 * the autoloader will first look for the class under the component/
 * directory, and it will then fallback to the framework/ directory if not
 * found before giving up.
 *
 * This class is loosely based on the Symfony UniversalClassLoader.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Jordi Boggiano <j.boggiano@seld.be>
 * @see    https://www.php-fig.org/psr/psr-0/
 * @see    https://www.php-fig.org/psr/psr-4/
 */
class ClassLoader
{
    /** @var \Closure(string):void */
    private static $includeFile;

    /** @var string|null */
    private $vendorDir;

    // PSR-4
    /**
     * @var array<string, array<string, int>>
     */
    private $prefixLengthsPsr4 = array();
    /**
     * @var array<string, list<string>>
     */
    private $prefixDirsPsr4 = array();
    /**
     * @var list<string>
     */
    private $fallbackDirsPsr4 = array();

    // PSR-0
    /**
     * List of PSR-0 prefixes
     *
     * Structured as array('F (first letter)' => array('Foo\Bar (full prefix)' => array('path', 'path2')))
     *
     * @var array<string, array<string, list<string>>>
     */
    private $prefixesPsr0 = array();
    /**
     * @var list<string>
     */
    private $fallbackDirsPsr0 = array();

    /** @var bool */
    private $useIncludePath = false;

    /**
     * @var array<string, string>
     */
    private $classMap = array();

    /** @var bool */
    private $classMapAuthoritative = false;

    /**
     * @var array<string, bool>
     */
    private $missingClasses = array();

    /** @var string|null */
    private $apcuPrefix;

    /**
     * @var array<string, self>
     */
    private static $registeredLoaders = array();

    /**
     * @param string|null $vendorDir
     */
    public function __construct($vendorDir = null)
    {
        $this->vendorDir = $vendorDir;
        self::initializeIncludeClosure();
    }

    /**
     * @return array<string, list<string>>
     */
    public function getPrefixes()
    {
        if (!empty($this->prefixesPsr0)) {
            return call_user_func_array('array_merge', array_values($this->prefixesPsr0));
        }

        return array();
    }

    /**
     * @return array<string, list<string>>
     */
    public function getPrefixesPsr4()
    {
        return $this->prefixDirsPsr4;
    }

    /**
     * @return list<string>
     */
    public function getFallbackDirs()
    {
        return $this->fallbackDirsPsr0;
    }

    /**
     * @return list<string>
     */
    public function getFallbackDirsPsr4()
    {
        return $this->fallbackDirsPsr4;
    }

    /**
     * @return array<string, string> Array of classname => path
     */
    public function getClassMap()
    {
        return $this->classMap;
    }

    /**
     * @param array<string, string> $classMap Class to filename map
     *
     * @return void
     */
    public function addClassMap(array $classMap)
    {
        if ($this->classMap) {
            $this->classMap = array_merge($this->classMap, $classMap);
        } else {
            $this->classMap = $classMap;
        }
    }

    /**
     * Registers a set of PSR-0 directories for a given prefix, either
     * appending or prepending to the ones previously set for this prefix.
     *
     * @param string              $prefix  The prefix
     * @param list<string>|string $paths   The PSR-0 root directories
     * @param bool                $prepend Whether to prepend the directories
     *
     * @return void
     */
    public function add($prefix, $paths, $prepend = false)
    {
        $paths = (array) $paths;
        if (!$prefix) {
            if ($prepend) {
                $this->fallbackDirsPsr0 = array_merge(
                    $paths,
                    $this->fallbackDirsPsr0
                );
            } else {
                $this->fallbackDirsPsr0 = array_merge(
                    $this->fallbackDirsPsr0,
                    $paths
                );
            }

            return;
        }

        $first = $prefix[0];
        if (!isset($this->prefixesPsr0[$first][$prefix])) {
            $this->prefixesPsr0[$first][$prefix] = $paths;

            return;
        }
        if ($prepend) {
            $this->prefixesPsr0[$first][$prefix] = array_merge(
                $paths,
                $this->prefixesPsr0[$first][$prefix]
            );
        } else {
            $this->prefixesPsr0[$first][$prefix] = array_merge(
                $this->prefixesPsr0[$first][$prefix],
                $paths
            );
        }
    }

        /**
         * Enregistre un ensemble de répertoires PSR-4 pour un espace de noms donné,
         * en les ajoutant soit à la fin, soit au début de ceux déjà définis pour cet espace de noms.
         *
         * @param string              $prefix  Le préfixe/espace de noms, avec un '\\' à la fin
         * @param list<string>|string $paths   Les répertoires de base PSR-4
         * @param bool                $prepend Indique s'il faut ajouter les répertoires au début
         *
         * @throws \InvalidArgumentException
         *
         * @return void
         */
        public function addPsr4($prefix, $paths, $prepend = false)
        {
            $paths = (array) $paths;
            if (!$prefix) {
                // Enregistre les répertoires pour l'espace de noms racine.
                if ($prepend) {
                    $this->fallbackDirsPsr4 = array_merge(
                        $paths,
                        $this->fallbackDirsPsr4
                    );
                } else {
                    $this->fallbackDirsPsr4 = array_merge(
                        $this->fallbackDirsPsr4,
                        $paths
                    );
                }
            } elseif (!isset($this->prefixDirsPsr4[$prefix])) {
                // Enregistre les répertoires pour un nouvel espace de noms.
                $length = strlen($prefix);
                if ('\\' !== $prefix[$length - 1]) {
                    throw new \InvalidArgumentException("Un préfixe PSR-4 non vide doit se terminer par un séparateur d'espace de noms.");
                }
                $this->prefixLengthsPsr4[$prefix[0]][$prefix] = $length;
                $this->prefixDirsPsr4[$prefix] = $paths;
            } elseif ($prepend) {
                // Ajoute les répertoires pour un espace de noms déjà enregistré.
                $this->prefixDirsPsr4[$prefix] = array_merge(
                    $paths,
                    $this->prefixDirsPsr4[$prefix]
                );
            } else {
                // Ajoute les répertoires pour un espace de noms déjà enregistré.
                $this->prefixDirsPsr4[$prefix] = array_merge(
                    $this->prefixDirsPsr4[$prefix],
                    $paths
                );
            }
        }

        /**
         * Enregistre un ensemble de répertoires PSR-0 pour un préfixe donné,
         * en remplaçant tous les autres répertoires précédemment définis pour ce préfixe.
         *
         * @param string              $prefix Le préfixe
         * @param list<string>|string $paths  Les répertoires de base PSR-0
         *
         * @return void
         */
        public function set($prefix, $paths)
        {
            if (!$prefix) {
                $this->fallbackDirsPsr0 = (array) $paths;
            } else {
                $this->prefixesPsr0[$prefix[0]][$prefix] = (array) $paths;
            }
        }

        /**
         * Enregistre un ensemble de répertoires PSR-4 pour un espace de noms donné,
         * en remplaçant tous les autres répertoires précédemment définis pour cet espace de noms.
         *
         * @param string              $prefix Le préfixe/espace de noms, avec un '\\' à la fin
         * @param list<string>|string $paths  Les répertoires de base PSR-4
         *
         * @throws \InvalidArgumentException
         *
         * @return void
         */
        public function setPsr4($prefix, $paths)
        {
            if (!$prefix) {
                $this->fallbackDirsPsr4 = (array) $paths;
            } else {
                $length = strlen($prefix);
                if ('\\' !== $prefix[$length - 1]) {
                    throw new \InvalidArgumentException("Un préfixe PSR-4 non vide doit se terminer par un séparateur d'espace de noms.");
                }
                $this->prefixLengthsPsr4[$prefix[0]][$prefix] = $length;
                $this->prefixDirsPsr4[$prefix] = (array) $paths;
            }
        }

        /**
         * Active la recherche des fichiers de classe dans le chemin d'inclusion.
         *
         * @param bool $useIncludePath
         *
         * @return void
         */
        public function setUseIncludePath($useIncludePath)
        {
            $this->useIncludePath = $useIncludePath;
        }

        /**
         * Indique si l'autoloader utilise le chemin d'inclusion pour rechercher les classes.
         *
         * @return bool
         */
        public function getUseIncludePath()
        {
            return $this->useIncludePath;
        }

        /**
         * Désactive la recherche des répertoires de préfixe et de secours pour les classes
         * qui n'ont pas été enregistrées dans la table de classes.
         *
         * @param bool $classMapAuthoritative
         *
         * @return void
         */
        public function setClassMapAuthoritative($classMapAuthoritative)
        {
            $this->classMapAuthoritative = $classMapAuthoritative;
        }

        /**
         * Indique si la recherche de classe doit échouer si elle n'est pas trouvée dans la table de classes actuelle.
         *
         * @return bool
         */
        public function isClassMapAuthoritative()
        {
            return $this->classMapAuthoritative;
        }

        /**
         * Préfixe APCu à utiliser pour mettre en cache les classes trouvées/non trouvées, si l'extension est activée.
         *
         * @param string|null $apcuPrefix
         *
         * @return void
         */
        public function setApcuPrefix($apcuPrefix)
        {
            $this->apcuPrefix = function_exists('apcu_fetch') && filter_var(ini_get('apc.enabled'), FILTER_VALIDATE_BOOLEAN) ? $apcuPrefix : null;
        }

        /**
         * Le préfixe APCu utilisé, ou null si le cache APCu n'est pas activé.
         *
         * @return string|null
         */
        public function getApcuPrefix()
        {
            return $this->apcuPrefix;
        }

        /**
         * Enregistre cette instance en tant qu'autoloader.
         *
         * @param bool $prepend Indique s'il faut ajouter l'autoloader au début
         *
         * @return void
         */
        public function register($prepend = false)
        {
            spl_autoload_register(array($this, 'loadClass'), true, $prepend);

            if (null === $this->vendorDir) {
                return;
            }

            if ($prepend) {
                self::$registeredLoaders = array($this->vendorDir => $this) + self::$registeredLoaders;
            } else {
                unset(self::$registeredLoaders[$this->vendorDir]);
                self::$registeredLoaders[$this->vendorDir] = $this;
            }
        }

        /**
         * Désenregistre cette instance en tant qu'autoloader.
         *
         * @return void
         */
        public function unregister()
        {
            spl_autoload_unregister(array($this, 'loadClass'));

            if (null !== $this->vendorDir) {
                unset(self::$registeredLoaders[$this->vendorDir]);
            }
        }

        /**
         * Charge la classe ou l'interface donnée.
         *
         * @param  string    $class Le nom de la classe
         * @return true|null Vrai si chargé, null sinon
         */
        public function loadClass($class)
        {
            if ($file = $this->findFile($class)) {
                $includeFile = self::$includeFile;
                $includeFile($file);

                return true;
            }

            return null;
        }

        /**
         * Trouve le chemin du fichier où la classe est définie.
         *
         * @param string $class Le nom de la classe
         *
         * @return string|false Le chemin si trouvé, false sinon
         */
        public function findFile($class)
        {
            // Recherche dans la table de classes
            if (isset($this->classMap[$class])) {
                return $this->classMap[$class];
            }
            if ($this->classMapAuthoritative || isset($this->missingClasses[$class])) {
                return false;
            }
            if (null !== $this->apcuPrefix) {
                $file = apcu_fetch($this->apcuPrefix.$class, $hit);
                if ($hit) {
                    return $file;
                }
            }

            $file = $this->findFileWithExtension($class, '.php');

            // Recherche des fichiers Hack si nous utilisons HHVM
            if (false === $file && defined('HHVM_VERSION')) {
                $file = $this->findFileWithExtension($class, '.hh');
            }

            if (null !== $this->apcuPrefix) {
                apcu_add($this->apcuPrefix.$class, $file);
            }

            if (false === $file) {
                // Mémorise que cette classe n'existe pas.
                $this->missingClasses[$class] = true;
            }

            return $file;
        }

        /**
         * Retourne les chargeurs actuellement enregistrés, indexés par leurs répertoires de fournisseurs correspondants.
         *
         * @return array<string, self>
         */
        public static function getRegisteredLoaders()
        {
            return self::$registeredLoaders;
        }

        /**
         * @param  string       $class
         * @param  string       $ext
         * @return string|false
         */
        private function findFileWithExtension($class, $ext)
        {
            // Recherche PSR-4
            $logicalPathPsr4 = strtr($class, '\\', DIRECTORY_SEPARATOR) . $ext;

            $first = $class[0];
            if (isset($this->prefixLengthsPsr4[$first])) {
                $subPath = $class;
                while (false !== $lastPos = strrpos($subPath, '\\')) {
                    $subPath = substr($subPath, 0, $lastPos);
                    $search = $subPath . '\\';
                    if (isset($this->prefixDirsPsr4[$search])) {
                        $pathEnd = DIRECTORY_SEPARATOR . substr($logicalPathPsr4, $lastPos + 1);
                        foreach ($this->prefixDirsPsr4[$search] as $dir) {
                            if (file_exists($file = $dir . $pathEnd)) {
                                return $file;
                            }
                        }
                    }
                }
            }

            // Répertoires de secours PSR-4
            foreach ($this->fallbackDirsPsr4 as $dir) {
                if (file_exists($file = $dir . DIRECTORY_SEPARATOR . $logicalPathPsr4)) {
                    return $file;
                }
            }

            // Recherche PSR-0
            if (false !== $pos = strrpos($class, '\\')) {
                // Nom de classe avec espace de noms
                $logicalPathPsr0 = substr($logicalPathPsr4, 0, $pos + 1)
                    . strtr(substr($logicalPathPsr4, $pos + 1), '_', DIRECTORY_SEPARATOR);
            } else {
                // Nom de classe de type PEAR
                $logicalPathPsr0 = strtr($class, '_', DIRECTORY_SEPARATOR) . $ext;
            }

            if (isset($this->prefixesPsr0[$first])) {
                foreach ($this->prefixesPsr0[$first] as $prefix => $dirs) {
                    if (0 === strpos($class, $prefix)) {
                        foreach ($dirs as $dir) {
                            if (file_exists($file = $dir . DIRECTORY_SEPARATOR . $logicalPathPsr0)) {
                                return $file;
                            }
                        }
                    }
                }
            }

            // Répertoires de secours PSR-0
            foreach ($this->fallbackDirsPsr0 as $dir) {
                if (file_exists($file = $dir . DIRECTORY_SEPARATOR . $logicalPathPsr0)) {
                    return $file;
                }
            }

            // Chemins d'inclusion PSR-0
            if ($this->useIncludePath && $file = stream_resolve_include_path($logicalPathPsr0)) {
                return $file;
            }

            return false;
        }

        /**
         * @return void
         */
        private static function initializeIncludeClosure()
        {
            if (self::$includeFile !== null) {
                return;
            }

            /**
             * Inclusion isolée de portée.
             *
             * Empêche l'accès à $this/self depuis les fichiers inclus.
             *
             * @param  string $file
             * @return void
             */
            self::$includeFile = \Closure::bind(static function($file) {
                include $file;
            }, null, null);
        }
    }
