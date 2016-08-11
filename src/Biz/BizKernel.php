<?php
namespace Biz;

use Codeages\Biz\Framework\Context\Kernel;

class BizKernel extends Kernel
{
    public function boot($options = array())
    {
        $this->registerService();
        $this->put('migration_directories', dirname(dirname(__DIR__)). '/migrations');
        parent::boot();
    }

    public function registerProviders()
    {
        return [];
    }

    protected function registerService()
    {
        $this['user_dao'] = $this->dao(function($container) {
            return new User\Dao\Impl\UserDaoImpl($container);
        });

        $this['user_service'] = function($container) {
            return new User\Impl\UserServiceImpl($container);
        };

        $this['password_encoder'] = function($container) {
            return new \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder('sha256');
        };
    }
}