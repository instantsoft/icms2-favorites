<?php

class modelFavorites extends cmsModel {

    public function getUserExistsTargets($user_id){

        $this->filterEqual('user_id', $user_id);

        $this->group_by = 'i.controller, i.subject_id';

        $targets = $this->get('favorites', false, false);

        $result = [];

        if($targets){
            foreach ($targets as $target) {
                $result[$target['controller']][] = $target['subject_id'];
            }
        }

        return $result;
    }

    public function getUserFavoritesCount($user_id){

        $this->filterEqual('user_id', $user_id);

        return $this->getCount('favorites', 'item_id', true);
    }

    public function deleteUserFavorites($user_id){
        return $this->delete('favorites', $user_id, 'user_id');
    }

    public function deleteFavorite($params) {

        foreach ($params as $key => $value) {
            $this->filterEqual($key, $value);
        }

        return $this->deleteFiltered('favorites');
    }

    public function save($params) {
        return $this->insert('favorites', $params);
    }

    public function isInFavoritesList($params, $item_ids) {

        $this->selectOnly('item_id');

        $this->filterIn('item_id', $item_ids);

        foreach ($params as $key => $value) {
            $this->filterEqual($key, $value);
        }

        return $this->get('favorites', function(){
            return 1;
        }, 'item_id');
    }

    public function isInFavorites($params) {

        $this->selectOnly('item_id');

        foreach ($params as $key => $value) {
            $this->filterEqual($key, $value);
        }

        return $this->getItem('favorites') ? true : false;
    }

    public function deleteController($name) {

        $tables = ['favorites'];

        foreach ($tables as $table) {
            $this->db->dropTable($table);
        }

        $this->filterEqual('url', '{favorites:list}')->deleteFiltered('menu_items');

        return parent::deleteController($name);
    }

}
