<?php
/**
 * Класс Edit_Tag_Backend_Controller формирует страницу с формой для
 * редактирования тега блога, обновляет тег (запись в таблице БД),
 * получает данные от модели Tag_Backend_Model
 */
class Edit_Tag_Backend_Controller extends Tag_Backend_Controller {

    public function __construct($params = null) {
        parent::__construct($params);
    }

    /**
     * Функция получает от модели данные, необходимые для формирования страницы
     * с формой для редактирования тега блога
     */
    protected function input() {

        /*
         * сначала обращаемся к родительскому классу Tag_Backend_Controller,
         * чтобы установить значения переменных, которые нужны для работы всех его
         * потомков, потом переопределяем эти переменные (если необходимо) и
         * устанавливаем значения перменных, которые нужны для работы только
         * Edit_Tag_Backend_Controller
         */
        parent::input();

        // если не передан id тега или id тега не число
        if ( ! (isset($this->params['id']) && ctype_digit($this->params['id'])) ) {
            $this->notFoundRecord = true;
            return;
        } else {
            $this->params['id'] = (int)$this->params['id'];
        }

        // если данные формы были отправлены
        if ($this->isPostMethod()) {
            if (!$this->validateForm()) { // если при заполнении формы были допущены ошибки
                $this->redirect($this->tagBackendModel->getURL('backend/tag/edit/id/' . $this->params['id']));
            } else {
                $this->redirect($this->tagBackendModel->getURL('backend/tag/index'));
            }
        }

        $this->title = 'Редактирование тега. ' . $this->title;

        // формируем хлебные крошки
        $breadcrumbs = array(
            array('url' => $this->tagBackendModel->getURL('backend/index/index'), 'name' => 'Главная'),
            array('url' => $this->tagBackendModel->getURL('backend/tag/index'), 'name' => 'Теги'),
        );

        // получаем от модели информацию о теге
        $tag = $this->tagBackendModel->getTag($this->params['id']);
        // если запрошенный тег не найден в БД
        if (empty($tag)) {
            $this->notFoundRecord = true;
            return;
        }

        /*
         * массив переменных, которые будут переданы в шаблон center.php
         */
        $this->centerVars = array(
            // хлебные крошки
            'breadcrumbs' => $breadcrumbs,
            // атрибут action тега form
            'action'      => $this->tagBackendModel->getURL('backend/tag/edit/id/' . $this->params['id']),
            // уникальный идентификатор тега
            'id'          => $this->params['id'],
            // название тега
            'name'        => $tag['name'],
        );
        // если были ошибки при заполнении формы, передаем в шаблон массив сообщений об ошибках
        if ($this->issetSessionData('editTagForm')) {
            $this->centerVars['savedFormData'] = $this->getSessionData('editTagForm');
            $this->centerVars['errorMessage'] = $this->centerVars['savedFormData']['errorMessage'];
            unset($this->centerVars['savedFormData']['errorMessage']);
            $this->unsetSessionData('editTagForm');
        }

    }

    /**
     * Функция проверяет корректность введенных пользователем данных; если были допущены ошибки,
     * функция возвращает false; если ошибок нет, функция обновляет тег блога и возвращает true
     */
    private function validateForm() {

        /*
         * обрабатываем данные, полученные из формы
         */
        $data['name'] = trim(iconv_substr($_POST['name'], 0, 100));        // название тега

        // были допущены ошибки при заполнении формы?
        if (empty($data['name'])) {
            $errorMessage[] = 'Не заполнено обязательное поле «Название тега»';
        }

        /*
         * были допущены ошибки при заполнении формы, сохраняем введенные
         * пользователем данные, чтобы после редиректа снова показать форму,
         * заполненную введенными ранее данными и сообщением об ошибке
         */
        if ( ! empty($errorMessage)) {
            $data['errorMessage'] = $errorMessage;
            $this->setSessionData('editTagForm', $data);
            return false;
        }

        $data['id'] = $this->params['id']; // уникальный идентификатор тега

        // обращаемся к модели для обновления тега
        $this->tagBackendModel->updateTag($data);

        return true;

    }

}
