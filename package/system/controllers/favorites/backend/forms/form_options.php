<?php

class formFavoritesOptions extends cmsForm {

    public function init() {

        $subjects = cmsEventsManager::hookAll('favorites_subjects');

        return [
            [
                'type'   => 'fieldset',
                'childs' => [
                    new fieldListMultiple('show_in_list', [
                        'title'     => LANG_FAVORITES_TARGETS_LIST,
                        'default'   => [],
                        'generator' => function ($item) use($subjects) {

                            $items = [];

                            if (is_array($subjects)) {
                                foreach ($subjects as $subject_list) {
                                    foreach ($subject_list as $name => $item) {
                                        if ($item['params']['is_can_show_in_list']) {
                                            $items[$name] = $item['title'];
                                        }
                                    }
                                }
                            }

                            return $items;
                        }
                    ]),
                    new fieldListMultiple('show_in_item', [
                        'title'     => LANG_FAVORITES_TARGETS_ITEM,
                        'default'   => [],
                        'generator' => function ($item) use($subjects) {

                            $items = [];

                            if (is_array($subjects)) {
                                foreach ($subjects as $subject_list) {
                                    foreach ($subject_list as $name => $item) {
                                        if ($item['params']['is_can_show_in_item']) {
                                            $items[$name] = $item['title'];
                                        }
                                    }
                                }
                            }

                            return $items;
                        }
                    ])
                ]
            ]
        ];
    }

}
