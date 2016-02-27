<?php

namespace Kraken\Runtime\Provider\Runtime;

use Kraken\Core\CoreInterface;
use Kraken\Core\Service\ServiceProvider;
use Kraken\Core\Service\ServiceProviderInterface;

class RuntimeAutowireProvider extends ServiceProvider implements ServiceProviderInterface
{
    /**
     * @var string[]
     */
    protected $requires = [
        'Kraken\Loop\LoopExtendedInterface',
        'Kraken\Runtime\RuntimeInterface',
        'Kraken\Runtime\Supervision\Base\SupervisionManagerInterface',
        'Kraken\Runtime\RuntimeManagerInterface'
    ];

    /**
     * @param CoreInterface $core
     */
    protected function register(CoreInterface $core)
    {
        $loop    = $core->make('Kraken\Loop\LoopExtendedInterface');
        $runtime = $core->make('Kraken\Runtime\RuntimeInterface');
        $error   = $core->make('Kraken\Runtime\Supervision\Base\SupervisionManagerInterface');
        $manager = $core->make('Kraken\Runtime\RuntimeManagerInterface');

        $model = $runtime->model();
        $model->setLoop($loop);
        $model->setErrorManager($error);
        $model->setRuntimeManager($manager);
    }
}
