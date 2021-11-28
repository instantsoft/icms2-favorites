<?php
/**
 * @property \modelFavorites $model
 */
class favorites extends cmsFrontend {

    protected $unknown_action_as_index_param = true;

    public function before($action_name) {

        parent::before($action_name);

        if(!$this->request->isInternal()){

            if (!$this->cms_user->is_logged){
                return cmsCore::error404();
            }
        }

        return true;
    }

}
