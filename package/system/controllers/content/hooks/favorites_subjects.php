<?php

class onContentFavoritesSubjects extends cmsAction {

    public function run($targets){

        $menu_items = [];

        if(empty($targets[$this->name])){
            return $menu_items;
        }

        $ctypes = $this->model->getContentTypes();

        foreach($ctypes as $ctype){

            if(!in_array($ctype['id'], $targets[$this->name])){
                continue;
            }

            $key = $this->name.'-'.$ctype['id'];

            $menu_items[$key] = [
                'title' => $ctype['title'],
                'url'   => href_to('favorites', $key)
            ];
        }

        return $menu_items;
    }

}
