<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Action;

trait Create {

    use Model;

    public function saveAction(): bool {
        if (!$this->request->isPost()) {
            return false;
        }
    }
}