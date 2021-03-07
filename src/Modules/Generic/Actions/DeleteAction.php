<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phalcon\Http\ResponseInterface;

trait DeleteAction {
    
    use Model;

    public function deleteAction(int $id): ResponseInterface {
        $this->view->disable();

        $defaultRoute = $this->getBasePosition();

        if(!$this->request->isPost()) {
            return $this->response->redirect($defaultRoute);
        }

        $record = $model->findFirstByid($id);

        if($record) {
            $record->status = 0;

            $record->save();
        }

        return $this->response->redirect($defaultRoute);
    }
}