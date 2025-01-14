<?php

class onCommentsFavoritesSubjects extends cmsAction {

    public function run($targets = []){

        $menu_items = [];

        if($targets && empty($targets[$this->name])){
            return $menu_items;
        }

        $key = $this->name.'-1';

        $menu_items[$key] = [
            'title'  => LANG_COMMENTS_CONTROLLER,
            'url'    => href_to('favorites', $key),
            'params' => [
                'is_can_show_in_list' => true,
                'is_can_show_in_item' => false
            ]
        ];

        return $menu_items;
    }

}
