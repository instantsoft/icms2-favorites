<?php
/**
 * @property \modelFavorites $model
 */
class favorites extends cmsFrontend {

    protected $useOptions = true;

    protected $unknown_action_as_index_param = true;

    const DEFAULT_SUBJECT_ID = 1;

    public function before($action_name) {

        parent::before($action_name);

        if(!$this->request->isInternal()){

            if (!$this->cms_user->is_logged){
                return cmsCore::error404();
            }
        }

        return true;
    }

    public function isShow(string $type, string $subject) {

        if (!cmsUser::isAllowed($this->name, 'usage', true, true)) {
            return false;
        }

        $key = 'show_in_' . $type;

        // Не задавали опции вообще
        if (!array_key_exists($key, $this->options)) {
            return true;
        }

        if (!$this->options[$key]) {
            return false;
        }

        return in_array($subject, $this->options[$key]);
    }

    public function isShowInList($subject) {
        return $this->isShow('list', $subject);
    }

    public function isShowInItem($subject) {
        return $this->isShow('item', $subject);
    }

}
