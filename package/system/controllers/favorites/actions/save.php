<?php
/**
 * @property \modelFavorites $model
 */
class actionFavoritesSave extends cmsAction {

    public function run($controller_name, $subject_id, $item_id) {

        if (!$this->request->isAjax()){
            return cmsCore::error404();
        }

        if (!cmsForm::validateCSRFToken($this->request->get('csrf_token'))){
            return $this->cms_template->renderJSON([
                'error'   => true,
                'message' => 'csrf_token error'
            ]);
        }

        if($this->validate_sysname($controller_name) !== true){
            return cmsCore::error404();
        }

        if(!cmsCore::isControllerExists($controller_name)) {
            return cmsCore::error404();
        }

        if(!is_numeric($subject_id) || !is_numeric($item_id)){
            return cmsCore::error404();
        }

        $params = [
            'controller' => $controller_name,
            'subject_id' => $subject_id,
            'user_id'    => $this->cms_user->id,
            'item_id'    => $item_id
        ];

        $is_in_favorites = $this->model->isInFavorites($params);

        if(!$is_in_favorites){
            $this->model->save($params);
        }

        return $this->cms_template->renderJSON([
            'error' => false,
            'data' => [
                'is_added' => true,
                'href' => href_to($this->name, 'delete', [$controller_name, $subject_id, $item_id]),
                'html' => LANG_FAVORITES_SAVED
            ]
        ]);
    }

}
