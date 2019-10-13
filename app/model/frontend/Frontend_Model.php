<?php
/**
 * Абстрактный класс Frontend_Model, родительский для всех моделей
 * общедоступной части сайта
 */
abstract class Frontend_Model extends Base_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Функция возвращает абсолютный URL вида http://www.server.com/frontend/
     * controller/action/param/value принимая на вход относительный URL вида
     * frontend/controller/action/param/value. Если в настройках указано
     * использовать SEF (ЧПУ), функция возвращает абсолютный SEF URL.
     */
    public function getURL($url) {

        /*
         * Ищем совпадение URL вида Controller/Action/Params (CAP), если находим —
         * заменяем CAP на SEF (Search Engines Friendly). Пример преобразования
         * frontend/catalog/category/id/27 => http://www.host.ru/catalog/category/27
         */
        $cap2sef = $this->config->sef->cap2sef;
        foreach($cap2sef as $key => $value) {
            if (preg_match($key, $url)) {
                return $this->config->site->url . preg_replace($key, $value, $url);
            }
        }

        /*
         * Совпадений не найдено, ищем среди страниц сайта; если совпадение найдено,
         * заменяем frontend/page/index/id/123 на http://www.host.ru/about-company
         */
        if (preg_match('~frontend/page/index/id/(\d+)~', $url, $matches)) {
            $id = (int)$matches[1];
            $query = "SELECT `sefurl` FROM `pages` WHERE `id` = :id";
            $sef = $this->database->fetchOne($query, array('id' => $id));
            if (false !== $sef) {
                return $this->config->site->url . $sef;
            }

        }

        // ничего не найдено
        throw new Exception('Не найдено правило преобразования CAP->SEF для ' . $url);

    }

    /*
     * Функция «подсвечивает» блоки кода, которые встречаются в HTML-тексте
     */
    protected function highlightCodeBlocks($html) {
        $langs = array('apache', 'awk', 'bash', 'cli', 'code', 'css', 'html', 'less', 'js', 'json', 'jsx', 'ini', 'php', 'phtml', 'mysql', 'python', 'idle', 'scss', 'xml', 'запрос', 'язык');
        if (preg_match_all('~\[('.implode('|', $langs).')\](.+)\[/\1\]~Us', $html, $matches)) {
            foreach($matches[0] as $key => $value) {
                $lang = $matches[1][$key];
                $code = $this->highlightCodeBlock($matches[2][$key], $lang);
                $html = str_replace($value, $code, $html);
            }
        }
        return $html;
    }

    /*
     * Функция возвращает «подсвеченный» код на разных языках программирования
     */
    private function highlightCodeBlock($code, $lang) {
        $hl = new Highlight();
        switch ($lang) {
            case 'apache': return $hl->highlightApache($code);
            case 'awk'   : return $hl->highlightAWK($code);
            case 'bash'  : return $hl->highlightBash($code);
            case 'cli'   : return $hl->highlightCLI($code);
            case 'code'  : return $hl->highlightCode($code);
            case 'css'   : return $hl->highlightCSS($code);
            case 'html'  : return $hl->highlightHTML($code);
            case 'less'  : return $hl->highlightLESS($code);
            case 'js'    : return $hl->highlightJS($code);
            case 'json'  : return $hl->highlightJSON($code);
            case 'jsx'   : return $hl->highlightJSX($code);
            case 'ini'   : return $hl->highlightINI($code);
            case 'php'   : return $hl->highlightPHP($code);
            case 'phtml' : return $hl->highlightPHTML($code);
            case 'mysql' : return $hl->highlightMySQL($code);
            case 'python': return $hl->highlightPython($code);
            case 'idle'  : return $hl->highlightIDLE($code);
            case 'scss'  : return $hl->highlightSCSS($code);
            case 'xml'   : return $hl->highlightXML($code);
            case 'запрос': return $hl->highlightQuery($code);
            case 'язык'  : return $hl->highlightERP($code);
        }
    }

    private function highlightHTML($code) {

        $colors = array(
            'default'   => '#000000',
            'doctype'   => '#8B008B',
            'comment'   => '#888888',
            'string'    => '#0080FF',
            'command'   => '#008080',
            'entity'    => '#8000FF',
            'attribute' => '#808000',
            'number'    => '#CCCCCC'
        );

        $code = trim($code);
        $code = str_replace("\r\n", "\n", $code);
        $code = str_replace("\t", '    ', $code); // замена табуляции на 4 пробела

        /*
         * заменяем html-сущности, чтобы безопасно раскрашивать код
         */
        if (preg_match_all('~&[a-z]+;~', $code, $matches)) {
            foreach($matches[0] as $item) {
                $entity_source[] = '<span style="color:'.$colors['entity'].'">' . str_replace('&', '&amp;', $item) . '</span>';
                $temp = '¤'.md5(uniqid(mt_rand(), true)).'¤';
                $entity_replace[] = $temp;
                $code = str_replace($item, $temp, $code);
            }
        }
        /*
         * заменяем строки внутри тегов, чтобы безопасно раскрашивать код
         */
        if (preg_match_all('~<[a-z0-9]+.*[-a-z0-9]+=("[^"]*").*>~', $code, $matches)) {
            foreach($matches[1] as $item) {
                $string_source[] = '<span style="color:'.$colors['string'].'">' . $item . '</span>';
                $temp = '¤'.md5(uniqid(mt_rand(), true)).'¤';
                $string_replace[] = $temp;
                $code = str_replace($item, $temp, $code);
            }
        }
        if (preg_match_all('~<[a-z0-9]+.*[-a-z0-9]+=("[^"]*").*>~', $code, $matches)) {
            foreach($matches[1] as $item) {
                $string_source[] = '<span style="color:'.$colors['string'].'">' . $item . '</span>';
                $temp = '¤'.md5(uniqid(mt_rand(), true)).'¤';
                $string_replace[] = $temp;
                $code = str_replace($item, $temp, $code);
            }
        }
        if (preg_match_all('~<[a-z0-9]+.*[-a-z0-9]+=("[^"]*").*>~', $code, $matches)) {
            foreach($matches[1] as $item) {
                $string_source[] = '<span style="color:'.$colors['string'].'">' . $item . '</span>';
                $temp = '¤'.md5(uniqid(mt_rand(), true)).'¤';
                $string_replace[] = $temp;
                $code = str_replace($item, $temp, $code);
            }
        }

        // открывающие и закрывающие теги
        $code = preg_replace(
            '~<(/?)([a-z0-9]+)([^>]*)>~',
            '<span style="color:'.$colors['command'].'">&lt;$1$2</span><span style="color:'.$colors['attribute'].'">$3</span><span style="color:'.$colors['command'].'">&gt;</span>',
            $code
        );
        // комментарии
        $code = preg_replace(
            '~\<(\!--.*--)\>~',
            '<span style="color: '.$colors['comment'].'">&lt;$1&gt;</span>',
            $code
        );
        // <!DOCTYPE html>
        $code = preg_replace('~<(\!DOCTYPE[^>]*)>~', '<span style="color: '.$colors['doctype'].'">&lt;$1&gt;</span>', $code);

        /*
         * обратная замена сущностей после раскрашивания кода
         */
        if (!empty($entity_source)) {
            $code = str_replace($entity_replace, $entity_source, $code);
        }
        /*
         * обратная замена строк после раскрашивания кода
         */
        if (!empty($string_source)) {
            $code = str_replace($string_replace, $string_source, $code);
        }

        /*
         * нумерация строк кода
         */
        $lines = explode("\n", $code);
        $res = array();
        $number = 1;
        foreach($lines as $line) {
            $num = $number;
            if (strlen($number) == 1) {
                $num = '  '.$number;
            }
            if (strlen($number) == 2) {
                $num = ' '.$number;
            }
            $res[] = '<span style="color:'.$colors['number'].'">'.($num).'</span> '.$line;
            $number++;
        }
        $result = implode("\r\n", $res);

        return '<pre style="color:'.$colors['default'].'">'.$code.'</pre>';

    }

    private function highlightCSS($code) {

        $colors = array(
            'default'    => '#008080',
            'prop-name'  => '#8000FF',
            'prop-value' => '#0080FF',
            'comment'    => '#888888',
            'string'     => '#0000FF',
            'pseudo'     => '#FF8000',
            'delimiter'  => '#FF0000',
            'important'  => '#808000',
            'import'     => '#8B008B',
            'media'      => '#8B008B',
            'url'        => '#8B008B',
            'number'     => '#CCCCCC'
        );

        $code = trim($code);
        $code = str_replace("\r\n", "\n", $code);
        $code = str_replace("\t", '    ', $code); // замена табуляции на 4 пробела

        /*
         * Вырезаем все, что можно, и на это место вставляем уникальный идентификатор, чтобы потом выполнить замену
         * на раскрашенный код (с помощью <span style="color:#ff0000">код</span>). Вырезаем затем, чтобы во время
         * замены не заменить то, что не нужно. Например «= внутри <span>» на «<span style="color:#ff0000">=</span>»
         */

        // вырезаем комметарии, чтобы безопасно раскрашивать код
        if (preg_match_all('~/\*.*\*/~sU', $code, $matches)) {
            foreach ($matches[0] as $key => $value) {
                $comment_source[] = '<span style="color:'.$colors['comment'].'">'.$value.'</span>';
                $replace = md5(uniqid(mt_rand(), true));
                $comment_replace[] = $replace;
                $code = str_replace($value, $replace, $code);
            }
        }

        // вырезаем объявления (свойство:значение внутри {...}), чтобы безопасно раскрашивать код
        if (preg_match_all('~\{([^{}]+)\}~', $code, $matches)) {
            foreach ($matches[1] as $key => $value) {
                $temp = $value;
                if (preg_match_all('~([-a-z]+)\s*\:\s*([^;]+);~', $matches[1][$key], $m)) {
                    foreach ($m[0] as $k => $v) {
                        $tmp = '<span style="color:'.$colors['prop-name'].'">'.$m[1][$k].'</span><span style="color:'.$colors['delimiter'].'">:</span> <span style="color:'.$colors['prop-value'].'">'.$m[2][$k].'</span><span style="color:'.$colors['delimiter'].'">;</span>';
                        $tmp = str_replace(
                            '!important',
                            '<span style="color:'.$colors['delimiter'].'">!</span><span style="color:'.$colors['important'].'">important</span>',
                            $tmp
                        );
                        $tmp = preg_replace(
                            '~url\(([^)]+)\)~',
                            '<span style="color:'.$colors['url'].'">url</span><span style="color:'.$colors['delimiter'].'">(</span><span style="color:'.$colors['prop-value'].'">$1</span><span style="color:'.$colors['delimiter'].'">)</span>',
                            $tmp
                        );
                        $prop_source[] = $tmp;
                        $replace = md5(uniqid(mt_rand(), true));
                        $prop_replace[] = $replace;
                        // нам нужно заменить только первое вхождение, поэтому не используем $temp = str_replace($v, $replace, $temp);
                        $strpos = strpos($temp, $v);
                        $temp = substr_replace($temp, $replace, $strpos, strlen($v));
                    }
                    // нам нужно заменить только первое вхождение, поэтому не используем $code = str_replace($value, $temp, $code);
                    $strpos = strpos($code, $value);
                    $code = substr_replace($code, $temp, $strpos, strlen($value));
                }
            }
        }

        // вырезаем псевдо-класы и псевдо-элементы, чтобы безопасно раскрашивать код
        // ::first-letter или ::before
        if (preg_match_all('~\:\:[-a-z]+~', $code, $matches)) {
            foreach ($matches[0] as $key => $value) {
                $pseudo_source[] = '<span style="color:'.$colors['pseudo'].'">'.$value.'</span>';
                $replace = md5(uniqid(mt_rand(), true));
                $pseudo_replace[] = $replace;
                $code = str_replace($value, $replace, $code);
            }
        }
        // :not(:first-child) или :nth-child(even)
        if (preg_match_all('~\:[-a-z]+(?:\([^)]*\))~', $code, $matches)) {
            foreach ($matches[0] as $key => $value) {
                $pseudo_source[] = '<span style="color:'.$colors['pseudo'].'">'.$value.'</span>';
                $replace = md5(uniqid(mt_rand(), true));
                $pseudo_replace[] = $replace;
                $code = str_replace($value, $replace, $code);
            }
        }
        // :first-child или :first-of-type
        if (preg_match_all('~\:[-a-z]+~', $code, $matches)) {
            foreach ($matches[0] as $key => $value) {
                $pseudo_source[] = '<span style="color:'.$colors['pseudo'].'">'.$value.'</span>';
                $replace = md5(uniqid(mt_rand(), true));
                $pseudo_replace[] = $replace;
                $code = str_replace($value, $replace, $code);
            }
        }

        // вырезаем строки в двойных кавычках, чтобы безопасно раскрашивать код
        if (preg_match_all('~"[^"]*"~', $code, $matches)) {
            foreach ($matches[0] as $key => $value) {
                $string_source[] = '<span style="color:'.$colors['string'].'">'.$value.'</span>';
                $replace = md5(uniqid(mt_rand(), true));
                $string_replace[] = $replace;
                $code = str_replace($value, $replace, $code);
            }

        }

        // вырезаем правило import, чтобы безопасно раскрашивать код
        $import_source = '<span style="color:'.$colors['import'].'">import</span>';
        $import_replace = md5(uniqid(mt_rand(), true));
        $code = preg_replace('~(?<=@)\bimport\b~', $import_replace, $code);
        // вырезаем правило media, чтобы безопасно раскрашивать код
        $media_source = '<span style="color:'.$colors['media'].'">media</span>';
        $media_replace = md5(uniqid(mt_rand(), true));
        $code = preg_replace('~(?<=@)\bmedia\b~', $media_replace, $code);

        // вырезаем разделители, чтобы безопасно раскрашивать код
        $temp = array('#', '.', '+', '~', ',', '>', ':', ';', '[', ']', '(', ')', '{', '}', '=', '@');
        foreach($temp as $value) {
            $delimiters['chars'][] = $value;
            $delimiters['source'][] = '<span style="color:'.$colors['delimiter'].'">'.htmlspecialchars($value).'</span>';
            $delimiters['replace'][] = md5(uniqid(mt_rand(), true));
        }
        $code = str_replace($delimiters['chars'], $delimiters['replace'], $code);

        /*
         * Теперь возвращаем на место все, что вырезали ранее, но уже в раскрашенном виде
         */

        // возвращаем на место разделители
        $code = str_replace($delimiters['replace'], $delimiters['source'], $code);
        // возвращаем на место строки в кавычках
        if (!empty($string_replace)) {
            $code = str_replace($string_replace, $string_source, $code);
        }
        // возвращаем на место объявления
        if (!empty($prop_replace)) {
            $code = str_replace($prop_replace, $prop_source, $code);
        }
        // возвращаем на место псевдо-класы и псевдо-элементы
        if (!empty($pseudo_replace)) {
            $code = str_replace($pseudo_replace, $pseudo_source, $code);
        }
        // возвращаем на место комментарии
        if (!empty($comment_replace)) {
            $code = str_replace($comment_replace, $comment_source, $code);
        }
        // возвращаем на место import
        $code = str_replace($import_replace, $import_source, $code);
        // возвращаем на место media
        $code = str_replace($media_replace, $media_source, $code);

        /*
         * нумерация строк кода
         */
        $lines = explode("\n", $code);
        $res = array();
        $number = 1;
        foreach($lines as $line) {
            $num = $number;
            if (strlen($number) == 1) {
                $num = '  '.$number;
            }
            if (strlen($number) == 2) {
                $num = ' '.$number;
            }
            $res[] = '<span style="color:'.$colors['number'].'">'.($num).'</span> '.$line;
            $number++;
        }
        $result = implode("\r\n", $res);

        return '<pre style="color:'.$colors['default'].'">'.$code.'</pre>';

    }

    private function highlightJS($code) {
        return '<pre style="color:#0000ff">'.htmlspecialchars($code).'</pre>';
    }

    private function highlightPHP($code) {
        return highlight_string($code, true);
    }

    private function highlightMysql($code) {
        return '<pre style="color:#0000ff">'.htmlspecialchars($code).'</pre>';
    }

    private function highlightERP($code) {

        $keywords1 = array(
            'Процедура', 'КонецПроцедуры', 'Функция', 'КонецФункции', 'Возврат', 'Экспорт', 'Знач', 'Перем', 'Новый'
        );
        $keywords2 = array(
            'Пока', 'Для', 'Каждого', 'Из', 'Цикл', 'КонецЦикла', 'Прервать', 'Продолжить', 'Если',
            'Тогда', 'Иначе', 'ИначеЕсли', 'КонецЕсли', 'Попытка', 'Исключение', 'КонецПопытки'
        );
        $keywords3 = array(
            'Истина', 'Ложь', 'НЕ', 'И', 'ИЛИ'
        );
        $delimiters = array(
            '=', ';', '.', '(', ')', '[', ']', ',', '+', '*', '-', '/', '!', '>', '<', '%'
        );
        $directives = array(
            '&НаКлиенте', '&НаСервере', '&НаСервереБезКонтекста', '&НаСервереНаКлиенте', '&НаКлиентеНаСервереБезКонтекста'
        );
        $colors = array(
            'default'   => '#008080',
            'directive' => '#808000',
            'comment'   => '#888888',
            'string'    => '#0000FF',
            'delimiter' => '#FF0000',
            'digit'     => '#FF00FF',
            'keyword1'  => '#8B008B',
            'keyword2'  => '#CD3700',
            'keyword3'  => '#8000FF',
            'object'    => '#0080FF',
            'number'    => '#CCCCCC'
        );

        $code = trim($code);
        $code = str_replace("\r\n", "\n", $code);
        $code = str_replace("\t", '    ', $code); // замена табуляции на 4 пробела

        /*
         * выделение блоков кода
         */
        // первый уровень
        $lines = explode("\n", $code);
        $result1 = array();
        $codeblock = false;
        $matchblock = '';
        foreach($lines as $line) {
            $line = rtrim($line);
            if ($codeblock && preg_match('~^ {4}(КонецЦикла|КонецЕсли|Иначе|Тогда)~', $line)) {
                $codeblock = false;
                $matchblock = '';
            }
            if ($codeblock) {
                if (preg_match('~^ {4}~', $line)) {
                    $line = preg_replace('~^ {4}~', '$0│', $line);
                } elseif ($line == '') {
                    $line = '    │';
                }
            }
            if (preg_match('~^ {4}(Для|Пока|Если|Иначе|Тогда)~', $line, $matches)) {
                $codeblock = true;
                $matchblock = $matches[1];
            }
            $result1[] = $line;
        }
        // второй уровень
        $result2 = array();
        $codeblock = false;
        $matchblock = '';
        foreach($result1 as $line) {
            if ($codeblock && preg_match('~^ {4}│? {4}(КонецЦикла|КонецЕсли|Иначе|Тогда)~', $line)) {
                $codeblock = false;
                $matchblock = '';
            }
            if ($codeblock) {
                if (preg_match('~^ {4}│? {4}~', $line)) {
                    $line = preg_replace('~^ {4}│? {4}~', '$0│', $line);
                } elseif ($line == '') {
                    $line = '        │';
                }
            }
            if (preg_match('~^ {4}│? {4}(Для|Пока|Если|Иначе|Тогда)~', $line, $matches)) {
                $codeblock = true;
                $matchblock = $matches[1];
            }
            $result2[] = $line;
        }
        $code = implode("\n", $result2);

        /*
         * заменяем строки на некий уникальный идентификатор, потом раскрашиваем код,
         * потом опять заменяем идентификаторы на строки
         * ИСХОДНАЯ СТРОКА:              Сообщение = "Какая-то строка";
         * СТРОКА ПОСЛЕ ЗАМЕНЫ:          Сообщение = abcdef123456;
         * СТРОКА ПОСЛЕ ОБРАБОТКИ:       Сообщение <span style="color:red">=</span> abcdef123456<span style="color:red">;</span>
         * СТРОКА ПОСЛЕ ОБРАТНОЙ ЗАМЕНЫ: Сообщение <span style="color:red">=</span> <span style="color:blue">"Какая-то строка"</span><span style="color:red">;</span>
         */

        /*
         * заменяем комментарии, чтобы безопасно раскрашивать код
         */
        if (preg_match_all('~(\/\/.*)$~m', $code, $matches)) {
            foreach($matches[0] as $key => $item) {
                $comment_source[$key] = '<span style="color:'.$colors['comment'].'">' . $item . '</span>';
                $rand = '¤'.md5(uniqid(mt_rand(), true)).'¤';
                $comment_replace[$key] = $rand;
                $code = preg_replace('~(\/\/.*)$~m', $rand, $code, 1);
            }
        }

        /*
         * заменяем строки, чтобы безопасно раскрашивать код
         */
        if (preg_match_all('~"[^"]*"~', $code, $matches)) {
            foreach($matches[0] as $key => $item) {
                $string_source[$key] = '<span style="color:'.$colors['string'].'">' . $item . '</span>';
                $string_replace[$key] = '¤'.md5(uniqid(mt_rand(), true)).'¤';
                $code = str_replace($item, $string_replace[$key], $code);
            }
        }
        /*
         * заменяем разделители, чтобы безопасно раскрашивать код
         */
        $temp = array();
        foreach($delimiters as $item) {
            $temp[] = '\\'.$item;
        }
        $regexp = '~'.implode('|', $temp).'~';
        if (preg_match_all($regexp, $code, $matches)) {
            foreach($matches[0] as $key => $item) {
                $delimiter_source[] = '<span style="color:'.$colors['delimiter'].'">' . $item . '</span>';
                $delimiter_replace[$key] = '¤'.md5(uniqid(mt_rand(), true)).'¤';
                $code = str_replace($item, $delimiter_replace[$key], $code);
            }
        }

        /*
         * теперь в тексте можно безопасно раскрашивать код, не опасаясь ненужных замен внутри строк или комментариев
         */
        // числа
        $code = preg_replace('~\b\d+\b~', '<span style="color:'.$colors['digit'].'">$0</span>', $code);
        // объекты
        $code = preg_replace('~Новый \b([а-яa-z]+)\b~ui', 'Новый <span style="color:'.$colors['object'].'">$1</span>', $code);
        // ключевые слова
        $code = preg_replace('~\b('.implode('|', $keywords1).')\b~ui', '<span style="color:'.$colors['keyword1'].'">$0</span>', $code);
        $code = preg_replace('~\b('.implode('|', $keywords2).')\b~ui', '<span style="color:'.$colors['keyword2'].'">$0</span>', $code);
        $code = preg_replace('~\b('.implode('|', $keywords3).')\b~ui', '<span style="color:'.$colors['keyword3'].'">$0</span>', $code);
        // директивы компиляции
        $code = preg_replace('~('.implode('|', $directives).')~ui', '<span style="color:'.$colors['directive'].'">$0</span>', $code);

        /*
         * обратная замена строк после раскрашивания кода
         */
        if (!empty($string_source)) {
            $code = str_replace($string_replace, $string_source, $code);
        }
        /*
         * обратная замена комментариев после раскрашивания кода
         */
        if (!empty($comment_source)) {
            $code = str_replace($comment_replace, $comment_source, $code);
        }
        /*
         * обратная замена разделитетей после раскрашивания кода
         */
        if (!empty($delimiter_source)) {
            $code = str_replace($delimiter_replace, $delimiter_source, $code);
        }

        /*
         * нумерация строк кода
         */
        $lines = explode("\n", $code);
        $res = array();
        $number = 1;
        foreach($lines as $line) {
            $num = $number;
            if (strlen($number) == 1) {
                $num = '  '.$number;
            }
            if (strlen($number) == 2) {
                $num = ' '.$number;
            }
            $res[] = '<span style="color:'.$colors['number'].'">'.($num).'</span> '.$line;
            $number++;
        }
        $result = implode("\r\n", $res);

        $code = str_replace('│', '<span class="codeblock"></span>', $code);

        return '<pre style="color:'.$colors['default'].'">'.$code.'</pre>';

    }

    private function highlightQuery($code) {
        return '<pre style="color:#0000ff">'.htmlspecialchars($code).'</pre>';
    }

    private function highlightPython($code) {
        $colors = array(
            'default'   => '#008080',
            'comment'   => '#888888',
            'string'    => '#0000FF',
            'delimiter' => '#FF0000',
            'digit'     => '#FF00FF',
            'number'    => '#CCCCCC',
            'keyword'   => '#8000FF',
        );

        $delimiters = array(',', ':', '[', ']', '(', ')', '=', '+', '{', '}');

        $keywords = array(
            'def', 'if', 'else', 'elif', 'for', 'in', 'not', 'del', 'try', 'except', 'True', 'False', 'from', 'import'
        );
        $code = trim($code);
        $code = str_replace("\r\n", "\n", $code);
        $code = str_replace("\t", '    ', $code); // замена табуляции на 4 пробела

        /*
         * заменяем комментарии, чтобы безопасно раскрашивать код
         */
        if (preg_match_all('~(#.*)$~m', $code, $matches)) {
            foreach($matches[0] as $key => $item) {
                $comment_source[$key] = '<span style="color:'.$colors['comment'].'">' . $item . '</span>';
                $comment_replace[$key] = '¤'.md5(uniqid(mt_rand(), true)).'¤';
                $code = str_replace($item, $comment_replace[$key], $code);
            }
        }
        /*
         * заменяем строки, чтобы безопасно раскрашивать код
         */
        if (preg_match_all('~"[^"]*"~', $code, $matches)) {
            foreach($matches[0] as $key => $item) {
                $string_source[$key] = '<span style="color:'.$colors['string'].'">' . $item . '</span>';
                $string_replace[$key] = '¤'.md5(uniqid(mt_rand(), true)).'¤';
                $code = str_replace($item, $string_replace[$key], $code);
            }
        }
        /*
         * заменяем разделители, чтобы безопасно раскрашивать код
         */
        $temp = array();
        foreach($delimiters as $item) {
            $temp[] = '\\'.$item;
        }
        $regexp = '~'.implode('|', $temp).'~';
        if (preg_match_all($regexp, $code, $matches)) {
            foreach($matches[0] as $key => $item) {
                $delimiter_source[] = '<span style="color:'.$colors['delimiter'].'">' . $item . '</span>';
                $delimiter_replace[$key] = '¤'.md5(uniqid(mt_rand(), true)).'¤';
                $code = str_replace($item, $delimiter_replace[$key], $code);
            }
        }

        /*
         * теперь в тексте можно безопасно раскрашивать код, не опасаясь ненужных замен внутри строк или комментариев
         */
        // числа
        $code = preg_replace('~\b\d+\b~', '<span style="color:'.$colors['digit'].'">$0</span>', $code);
        // ключевые слова
        $code = preg_replace('~\b('.implode('|', $keywords).')\b~ui', '<span style="color:'.$colors['keyword'].'">$0</span>', $code);

        /*
         * обратная замена строк после раскрашивания кода
         */
        if (!empty($string_source)) {
            $code = str_replace($string_replace, $string_source, $code);
        }
        /*
         * обратная замена комментариев после раскрашивания кода
         */
        if (!empty($comment_source)) {
            $code = str_replace($comment_replace, $comment_source, $code);
        }
        /*
         * обратная замена разделитетей после раскрашивания кода
         */
        if (!empty($delimiter_source)) {
            $code = str_replace($delimiter_replace, $delimiter_source, $code);
        }

        /*
         * нумерация строк кода
         */
        $lines = explode("\n", $code);
        $res = array();
        $number = 1;
        foreach($lines as $line) {
            $num = $number;
            if (strlen($number) == 1) {
                $num = '  '.$number;
            }
            if (strlen($number) == 2) {
                $num = ' '.$number;
            }
            $res[] = '<span style="color:'.$colors['number'].'">'.($num).'</span> '.$line;
            $number++;
        }
        $result = implode("\r\n", $res);

        return '<pre style="color:'.$colors['default'].'">'.$code.'</pre>';
    }

    private function highlightBash($code) {
        return '<pre style="color:#0000ff">'.htmlspecialchars($code).'</pre>';
    }

    private function highlightCLI($code) {
        $colors = array(
            'default' => '#0080FF',
            'command' => '#8000FF',
            'warning' => '#808000',
            'green'   => '#008080',
            'red'     => '#EE0000'
        );
        $code = trim($code);
        $code = str_replace("\r\n", "\n", $code);
        $code = str_replace("\t", '    ', $code); // замена табуляции на 4 пробела

        $lines = explode("\n", $code);
        $result = array();
        foreach($lines as $line) {
            $first = substr($line, 0, 2);
            if (in_array($first, array('$ ', '> '))) {
                $result[] = '<span style="color:'.$colors['command'].'">'.htmlspecialchars($line).'</span>';
            } elseif ($first == '# ') {
                $result[] = '<span style="color:'.$colors['warning'].'">'.htmlspecialchars($line).'</span>';
            } else {
                $result[] = htmlspecialchars($line);
            }
        }

        $code = implode("\r\n", $result);
        $code = str_replace(
            array(
                '[grn]',
                '[red]',
                '[/grn]',
                '[/red]'
            ),
            array(
                '<span style="color:'.$colors['green'].'">',
                '<span style="color:'.$colors['red'].'">',
                '</span>',
                '</span>',
            ),
            $code
        );

        return '<pre style="color:'.$colors['default'].'">'.$code.'</pre>';
    }

    private function highlightIDLE($code) {
        $colors = array(
            'default' => '#0080FF',
            'command' => '#8000FF',
            'green'   => '#008080',
            'red'     => '#EE0000'
        );
        $code = trim($code);
        $code = str_replace("\r\n", "\n", $code);
        $code = str_replace("\t", '    ', $code); // замена табуляции на 4 пробела

        $lines = explode("\n", $code);
        $result = array();
        foreach($lines as $line) {
            $first = substr($line, 0, 3);
            if (in_array($first, array('...', '>>>'))) {
                $result[] = '<span style="color:'.$colors['command'].'">'.htmlspecialchars($line, ENT_NOQUOTES).'</span>';
            } else {
                $result[] = htmlspecialchars($line, ENT_NOQUOTES);
            }
        }

        $code = implode("\r\n", $result);
        $code = str_replace(
            array(
                '[grn]',
                '[red]',
                '[/grn]',
                '[/red]'
            ),
            array(
                '<span style="color:'.$colors['green'].'">',
                '<span style="color:'.$colors['red'].'">',
                '</span>',
                '</span>',
            ),
            $code
        );
        return '<pre style="color:'.$colors['default'].'">'.$code.'</pre>';
    }

    private function highlightCode($code) {
        $colors = array(
            'default' => '#0080FF',
            'green'   => '#008080',
            'red'     => '#EE0000'
        );
        $code = htmlspecialchars($code, ENT_NOQUOTES);
        $code = str_replace(
            array(
                '[grn]',
                '[red]',
                '[/grn]',
                '[/red]'
            ),
            array(
                '<span style="color:'.$colors['green'].'">',
                '<span style="color:'.$colors['red'].'">',
                '</span>',
                '</span>',
            ),
            $code
        );
        return '<pre style="color:'.$colors['default'].'">'.$code.'</pre>';
    }

}