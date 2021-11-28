<?php
/**
 * @property \modelFavorites $model
 */
class onFavoritesMenuFavorites extends cmsAction {

    public function run($item){

        if (!$this->cms_user->is_logged) { return false; }

        $action = $item['action'];

        if ($action == 'list'){

            $counts = $this->model->getUserFavoritesCount($this->cms_user->id);
            if (!$counts) { return false; }

            return [
                'url'     => href_to($this->name),
                'counter' => $counts
            ];
        }

        return false;
    }

}
