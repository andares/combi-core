<?php

namespace Combi\Core;

use Combi\Traits;
use Combi\Meta;
use Combi\Base\Container;


/**
 * Description of Runtime
 *
 * @author andares
 */
class Runtime extends Container {
    use Traits\Instancable,
        Meta\Overloaded;

    private $_config = [];

    /**
     * @var bool
     */
    private $_is_ready = false;

    /**
     * @var Package
     */
    private $_main_package = null;

    /**
     *
     * @param array $config
     * @return self
     */
    public function setup(array $config): self {
        $this->_config = array_merge($this->_config, $config);
        return $this;
    }

    /**
     * package->run()时初发的后初始化。
     * 该方法需要保证只运行一次。
     *
     * @param Package $package
     * @return self
     */
    public function ready(Package $package): self {
        if ($this->_is_ready) {
            return $this;
        }

        $this->_main_package = $package;

        $this->_is_ready = true;
        return $this;
    }

    /**
     * @return Package
     */
    public function main(): Package {
        return $this->_main_package;
    }

    /**
     * @return bool
     */
    public function is_prod(): bool {
        return  $this->_config['is_prod'];
    }

    /**
     *
     *
     * @param ?string $key
     * @return mixed
     */
    public function config(?string $key = null) {
        if ($key) {
            return $this->_config[$key] ?? null;
        }
        return $this->_config;
    }

    /**
     * @param string $dir
     * @return Resource\Directory
     */
    public function dir(string $dir): Resource\Directory {
        return Resource\Directory::instance($dir);
    }

    /**
     * 注册一个package到runtime
     *
     * @param Package $package
     * @return self
     */
    public function register(Package $package): self {
        $pid = $package->pid();
        $this->set($pid, $package);
        return $this;
    }

}
