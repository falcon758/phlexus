<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phalcon\Http\ResponseInterface;
use Phlexus\Modules\BaseUser\Models\Profile;

/**
 * Trait DeleteAction
 *
 * @package Phlexus\Modules\Generic\Actions
 */
trait DeleteAction {
    
    use \Phlexus\Modules\Generic\Model;

    /**
     * Delete Action
     *
     * @param int $id The model id
     * 
     * @return ResponseInterface
     */
    public function deleteAction(int $id): ResponseInterface {
        $this->view->disable();

        $defaultRoute = $this->getBasePosition();

        //Response instance
        $response = new \Phalcon\Http\Response();

        //Content of the response
        $response = ['status' => 0];

        if (!$this->request->isPost() 
            || !$this->security->checkToken('csrf', $this->request->getPost('csrf', null))) {
            $this->flash->error('Invalid form data!');

            return $this->response->setJsonContent($response);
        }

        $model = $this->getModel();

        $isAdmin = Profile::getUserProfile()->isAdmin();

        // Check if user has delete permissions
        if (!$isAdmin) {
            $this->flash->error('No permissions to delete!');

            return $this->response->setJsonContent($response);
        }

        $record = $model->findFirstByid($id);

        if ($record) {
            $record->active = 0;

            if ($record->save()) {
                $this->flash->success('Deleted successfully');

                $response['status'] = 1;
            }
        }

        return $this->response->setJsonContent($response);
    }
}