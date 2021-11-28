<?php
/**
 * @property \modelFavorites $model
 */
class onFavoritesContentAfterDelete extends cmsAction {

    public function run($data){

        $ctype = $data['ctype'];
        $item  = $data['item'];

        $this->model->deleteFavorite([
            'controller' => 'content',
            'subject_id' => $ctype['id'],
            'item_id'    => $item['id']
        ]);

        return $data;
    }

}
