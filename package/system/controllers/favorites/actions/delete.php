<?php
/**
 * @property \modelFavorites $model
 */
class actionFavoritesDelete extends cmsAction {

    public function run($controller_name, $subject_id, $item_id) {

        if (!$this->request->isAjax()) {
            return cmsCore::error404();
        }

        if (!cmsForm::validateCSRFToken($this->request->get('csrf_token'))){
            return $this->cms_template->renderJSON([
                'error'   => true,
                'message' => ''
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

        if (!$this->isShowInList($controller_name.'-'.$subject_id) && !$this->isShowInItem($controller_name.'-'.$subject_id)) {
            return cmsCore::error404();
        }

        $this->model->deleteFavorite([
            'controller' => $controller_name,
            'subject_id' => $subject_id,
            'user_id'    => $this->cms_user->id,
            'item_id'    => $item_id
        ]);

        return $this->cms_template->renderJSON([
            'error' => false,
            'data' => [
                'is_added' => false,
                'href' => href_to($this->name, 'save', [$controller_name, $subject_id, $item_id]),
                'html' => LANG_FAVORITES_ADD
            ]
        ]);
    }

}
