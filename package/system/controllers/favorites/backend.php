<?php

class backendFavorites extends cmsBackend {

    public $useDefaultOptionsAction     = true;
    public $useDefaultPermissionsAction = true;

    protected $useOptions = true;

    public function __construct(cmsRequest $request) {

        parent::__construct($request);

        array_unshift($this->backend_menu,
            [
                'title' => LANG_OPTIONS,
                'url'   => href_to($this->root_url),
                'options' => [
                    'icon' => 'cog'
                ]
            ],
            [
                'title' => LANG_PERMISSIONS,
                'url'   => href_to($this->root_url, 'perms', 'favorites'),
                'options' => [
                    'icon' => 'key'
                ]
            ]
        );
    }

}
