<?php

/**
 * Universal runonce loader script for extensions to Contao Open Source CMS
 * that want to support both, the ER2 and Composer installation
 *
 * @copyright  Copyright (c) 2013, terminal42 gmbh
 * @author     terminal42 gmbh <info@terminal42.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 */

// Configure your runonce paths here
$runonces = array(
    '/path/to/your/runonce/runonce.php'
);


// Do not change from here
if (!class_exists('Terminal42RunonceExecutorVersion100')) {
    class Terminal42RunonceExecutorVersion100 extends System
    {
        public function run(array $runonces)
        {
            foreach ($runonces as $runonce) {
                try {
                    require_once(TL_ROOT . DIRECTORY_SEPARATOR . $runonce);
                }
                catch (\Exception $e) {
                    trigger_error(
                        $e->getMessage() . "\n" . $e->getTraceAsString(),
                        E_USER_ERROR
                    );

                    $this->log(
                        $e->getMessage() . "\n" . $e->getTraceAsString(),
                        __METHOD__,
                        TL_ERROR
                    );
                }
            }
        }
    }
}

$runner = new Terminal42RunonceExecutorVersion100();
$runner->run($runonces);