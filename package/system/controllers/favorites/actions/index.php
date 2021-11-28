<?php
/**
 * @property \modelFavorites $model
 */
class actionFavoritesIndex extends cmsAction {

    public function run($target = ''){

        // субъект в формате controller_name-subject_id
        if($target && !preg_match('/^([a-z0-9\_]+\-{1}[0-9]+)$/', $target)){
            return cmsCore::error404();
        }

        $exists_targets = $this->model->getUserExistsTargets($this->cms_user->id);
        if(!$exists_targets){
            return cmsCore::error404();
        }

        $menu_items = cmsEventsManager::hookAll('favorites_subjects', $exists_targets);
        if (!$menu_items) { return cmsCore::error404(); }

        // субъект по умолчанию - первый из списка
        if(!$target){

            foreach ($menu_items as $controller_name => $_menu_items) {

                if(empty($_menu_items)){ continue; }

                $first_subject = array_keys($_menu_items);

                $target = $first_subject[0];

                // редиректим на правильный урл
                $this->redirect(href_to($this->name, $target), 301);
            }

        }

        list($target_controller, $target_subject_id) = explode('-', $target);

        if(!cmsCore::isControllerExists($target_controller) || !cmsController::enabled($target_controller)){
            return cmsCore::error404();
        }

        $page_url = href_to($this->name, $target);

        $controller = cmsCore::getController($target_controller, $this->request);

        $list_html = $controller->runHook('favorites_subject', [$target_subject_id, $page_url]);
        if (!$list_html) { return cmsCore::error404(); }

        foreach ($menu_items as $menu_item) {
            $this->cms_template->addMenuItems('results_tabs', $menu_item);
        }

        return $this->cms_template->render([
            'html' => $list_html
        ]);
    }

}
