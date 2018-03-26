<?php
/**
 * Класс Highlight, для подсветки кода в публикациях
 */
class Highlight {

    private $settings = array(
        'bash' => array(
            'colors' => array(
                'default'     => array('f' => '#008080'),
                'bin-bash'    => array('f' => '#888888', 'b' => '#FFFFFF'),
                'here-doc'    => array('f' => '#0080FF', 'b' => '#FFFFFF'),
                'comment1'    => array('f' => '#888888'),
                'comment2'    => array('f' => '#888888'),
                'comment3'    => array('f' => '#888888'),
                'string1'     => array('f' => '#0080FF'),
                'string2'     => array('f' => '#0000DD'),
                'variable1'   => array('f' => '#808000'),
                'variable2'   => array('f' => '#808000'),
                'spec-var'    => array('f' => '#808000'),
                'express1'    => array('b' => '#FFEEEE'),
                'express2'    => array('b' => '#FFEEEE'),
                'execute1'    => array('b' => '#FFFFEE'),
                'execute2'    => array('b' => '#FFFFEE'),
                'execute3'    => array('b' => '#FFFFEE'),
                'test-ext'    => array('b' => '#EEEEFF'),
                'keyword'     => array('f' => '#8000FF'),
                'digit'       => array('f' => '#DD00DD'),
                'delimiter'   => array('f' => '#FF0000'),
                'number'      => array('f' => '#CCCCCC'),
            ),
            'keyword' => array(
                'if', 'then', 'else', 'elif', 'fi', 'for', 'while', 'until', 'break', 'continue', 'in', 'do', 'done', 'case', 'esac', 'exit', 'function'
            ),
            'delimiter' => array(
                ';', '&&', '\|\|', '\[', '\]', '\(\(', '\)\)'
            ),
        ),
        'css' => array(
            'colors' => array(
                'default'     => array('f' => '#008080'),
                'comment'     => array('f' => '#888888'),
                'string'      => array('f' => '#0000FF'),
                'import'      => array('f' => '#EE00EE'),
                'media'       => array('f' => '#EE00EE'),
                'prop-name'   => array('f' => '#8000FF'),
                'prop-value'  => array('f' => '#0080FF'),
                'css-uniq'    => array('f' => '#8B008B'),
                'css-class'   => array('f' => '#0000EE'),
                'pseudo-el'   => array('f' => '#FF8000'),
                'pseudo-cl'   => array('f' => '#FF8000'),
                'pseudo-cl-n' => array('f' => '#FF8000'),
                'delimiter'   => array('f' => '#FF0000'),
                'number'      => array('f' => '#CCCCCC'),
            ),
            'function' => array('url', 'attr', 'calc', 'rgb'),
            'delimiter' => array('+', '~', ',', '>', ':', ';', '[', ']', '(', ')', '{', '}', '='),
        ),
        'erp' => array(
            'colors' => array(
                'default'   => array('f' => '#008080'),
                'comment'   => array('f' => '#888888'),
                'string'    => array('f' => '#0000FF'),
                'keyword1'  => array('f' => '#8B008B'),
                'keyword2'  => array('f' => '#8000FF'),
                'keyword3'  => array('f' => '#EE00EE'),
                'directive' => array('f' => '#808000'),
                'digit'     => array('f' => '#FF00FF'),
                'delimiter' => array('f' => '#FF0000'),
                'object'    => array('f' => '#0080FF'),
                'number'    => array('f' => '#CCCCCC'),
            ),
            'keyword1' => array(
                'Процедура', 'КонецПроцедуры', 'Функция', 'КонецФункции', 'Возврат', 'Экспорт', 'Знач', 'Перем',
            ),
            'keyword2' => array(
                'Пока', 'Для', 'Каждого', 'Из', 'Цикл', 'КонецЦикла', 'Прервать', 'Продолжить', 'Если', 'Тогда', 'Иначе', 'ИначеЕсли', 'КонецЕсли', 'Попытка', 'Исключение', 'КонецПопытки', 'Новый'
            ),
            'keyword3' => array(
                'Истина', 'Ложь', 'НЕ', 'И', 'ИЛИ'
            ),
            'directive' => array(
                '&НаКлиенте', '&НаСервере', '&НаСервереБезКонтекста', '&НаСервереНаКлиенте', '&НаКлиентеНаСервереБезКонтекста'
            ),
            'delimiter' => array(
                '=', ';', '.', '(', ')', '[', ']', ',', '+', '*', '-', '/', '!', '>', '<', '%'
            ),
        ),
        'js' => array(
            'colors' => array(
                'default'   => array('f' => '#008080'),
                'comment1'  => array('f' => '#888888'),
                'comment2'  => array('f' => '#888888'),
                'string1'   => array('f' => '#0080FF'),
                'string2'   => array('f' => '#0080FF'),
                'keyword1'  => array('f' => '#8000FF'),
                'keyword2'  => array('f' => '#DD00DD'),
                'function'  => array('f' => '#990099'),
                'digit'     => array('f' => '#DD00DD'),
                'delimiter' => array('f' => '#FF5555'),
                'number'    => array('f' => '#CCCCCC'),
            ),
            'keyword1' => array(
                'if', 'else', 'elseif', 'for', 'while', 'foreach', 'as', 'break', 'continue', 'return', 'switch', 'case', 'default', 'delete', 'do', 'with', 'in', 'abstract', 'class', 'extends', 'function', 'final', 'public', 'protected', 'private', 'static', 'self', 'new', 'instanceof', 'interface', 'this', 'try', 'throw', 'throws', 'finally', 'implements', 'super', 'var',  'typeof', 'void'
            ),
            'keyword2' => array(
                'true', 'false', 'boolean', 'int', 'float', 'undefined', 'null'
            ),
            'function' => array(
                'alert', 'prompt', 'confirm', 'setTimeout', 'setInterval'
            ),
            'delimiter' => array(
                '.', ',', ':', ';', '=', '+', '-', '/', '*', '%', '[', ']', '(', ')', '{', '}', '>', '<', '|', '!', '?', '&'
            ),
        ),
        'php' => array(
            'colors' => array(
                'default'   => array('f' => '#008080'),
                'comment1'  => array('f' => '#888888'),
                'comment2'  => array('f' => '#888888'),
                'string1'   => array('f' => '#0000EE'),
                'string2'   => array('f' => '#0000FF'),
                'keyword1'  => array('f' => '#8000FF'),
                'keyword2'  => array('f' => '#808000'),
                'keyword3'  => array('f' => '#FF00FF'),
                'function'  => array('f' => '#0080FF'),
                'constant'  => array('f' => '#FF5500'),
                'digit'     => array('f' => '#FF00FF'),
                'delimiter' => array('f' => '#FF0000'),
                'number'    => array('f' => '#CCCCCC'),
            ),
            'keyword1' => array(
                'if', 'else', 'elseif', 'for', 'while', 'foreach', 'as', 'break', 'continue', 'try', 'catch', 'finally', 'throw', 'return', 'switch', 'case', 'default'
            ),
            'keyword2' => array(
                'abstract', 'class', 'extends', 'function', 'public', 'protected', 'private', 'static', 'self', 'new',  'array', 'list', 'echo', 'exit', 'die'
            ),
            'keyword3' => array(
                'true', 'false', 'null', 'int', 'float', 'bool'
            ),
            'function' => array(
                'echo', 'exit', 'die', 'isset', 'unset', 'implode', 'explode', 'get_class', 'lcfirst', 'ucfirst', 'iconv', 'empty', 'is_null', 'count', 'print_r', 'header', 'readfile', 'filesize', 'date', 'fopen', 'fsockopen', 'feof', 'fread', 'fwrite', 'fclose', 'urlencode', 'urldecode', 'file_get_contents', 'file_put_contents'
            ),
            'constant' => array(
                '__FUNCTION__', '__CLASS__', '__METHOD__'
            ),
            'delimiter' => array(
                '.', ',', ':', ';', '=', '+', '-', '/', '*', '%', '[', ']', '(', ')', '{', '}', '>', '<', '|', '!', '?', '&', '@'
            ),
        ),
        'python' => array(
            'colors' => array(
                'default'   => array('f' => '#008080'),
                'comment'   => array('f' => '#888888'),
                'string1'   => array('f' => '#0000FF'),
                'string2'   => array('f' => '#0000FF'),
                'string3'   => array('f' => '#0080FF'),
                'string4'   => array('f' => '#0080FF'),
                'keyword1'  => array('f' => '#8000FF'),
                'keyword2'  => array('f' => '#DD00DD'),
                'function'  => array('f' => '#0080FF'),
                'digit'     => array('f' => '#FF00FF'),
                'delimiter' => array('f' => '#FF0000'),
                'number'    => array('f' => '#CCCCCC'),
            ),
            'keyword1' => array(
                'def', 'if', 'else', 'elif', 'for', 'in', 'while', 'break', 'continue', 'del', 'try', 'except', 'raise', 'finally', 'from', 'import', 'return', 'pass', 'lambda', 'with', 'as', 'not', 'and', 'or', 'is'
            ),
            'keyword2' => array(
                'True', 'False', 'None'
            ),
            'function' => array(
                'object', 'dict', 'list', 'tuple', 'set', 'bool', 'float', 'int', 'str', 'slice', 'range', 'len', 'input', 'print', 'min', 'max', 'sum', 'round', 'type', 'open'
            ),
            'delimiter' => array(
                '.', ',', ':', '=', '+', '-', '/', '*', '%', '[', ']', '(', ')', '{', '}', '>', '<', '|', '!'
            ),
        ),
        'html' => array(
            'colors' => array(
                'default'   => array('f' => '#222222'),
                'doctype'   => array('f' => '#8B008B'),
                'comment'   => array('f' => '#888888'),
                'string'    => array('f' => '#0080FF'),
                'element'   => array('f' => '#008080'),
                'entity'    => array('f' => '#8000FF'),
                'attrname'  => array('f' => '#808000'),
                'attrvalue' => array('f' => '#0080FF'),
                'equal'     => array('f' => '#EE0000'),
                'number'    => array('f' => '#CCCCCC'),
            ),
        )
    );

    private $lang = 'code', $source = array(), $replace = array(), $pattern = array();

    public function highlightBash($code) {

        $this->init($code, 'bash');

        $this->pattern = array(
            'here-doc'     => '~\<\<-? ([_A-Z]+).*\1~s',  // here doc
            'comment1'    => '~^ *#+$~m',                 // пустой комментарий
            'comment2'    => '~^ *#+ .*$~m',              // комментарии от начала строки
            'comment3'    => '~(?<= )#+ .*~',             // комментарии в конце строки
            'spec-var'    => '~\$([0-9]|#|!|\*|@|\$|!)~i',// специальные переменные
            'variable1'   => '~\$[a-z_][a-z0-9_]*~i',     // переменные
            'variable2'   => '~\$\{[^}]+\}?~i',           // переменные
            //'express1'    => '~\$?\(\([^)(]+\)\)~',       // вычисление арифметического выражения
            'execute1'    => '~\$\([^)(]+\)~',            // подстановка результата выполнения
            //'express2'    => '~\$?\(\([^)(]+\)\)~',       // вычисление арифметического выражения
            'execute2'    => '~\$\([^)(]+\)~',            // подстановка результата выполнения
            'execute3'    => '~\`[^`]+`~',                // подстановка результата выполнения
            'string1'     => '~"[^"]*"~',                 // строки в двойных кавычках
            'string2'     => "~'[^']*'~",                 // строки в одинарных кавычках
            //'test-ext'    => '~\[(\[)? .+? (?(1)\])\]~',         // команда test или конструкция [[...]]
            'keyword'     => '~\b('.implode('|', $this->settings[$this->lang]['keyword']).')\b~i', // ключевые слова
            //'digit'     => '~(?<!&)\b\d+\b(?!\>)~',     // цифры (просмотр вперед и назад для потоков)
            //'delimiter' => '~'.implode('|', $this->settings[$this->lang]['delimiter']).'~',   // разделители
            'bin-bash'    => "~^#!/[-/a-z]+~",            // что-то типа #!/bin/bash
        );

        $this->hl();

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default']['f'].'">' . $this->code . '</pre>';

    }

    public function highlightCSS($code) {

        $this->init($code, 'css');

        foreach ($this->settings[$this->lang]['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $this->pattern = array(
            'comment'     => '~/\*.*\*/~sU',                     // комментарии
            'prop-name'   => '~^\s*[-a-z]+\s*(?=:)~m',           // свойство
            'prop-value'  => '~(?<=¤:)\s*[^;¤{]+\s*(?=;)~',      // значение свойства
            'string'      => '~"[^"]*"|\'[^\']*\'~',             // строка
            'import'      => '~@import~',                        // @import
            'media'       => '~@media~',                         // @media
            'css-uniq'    => '~#[-_a-z]+~',                      // селектор, идентификатор
            'css-class'   => '~\.[-_a-z]+~',                     // селектор, класс
            'pseudo-el'   => '~::[-a-z]+~',                      // псевдо-элементы ::first-letter или ::before
            'pseudo-cl-n' => '~:[-a-z]+\([^)]*\)~',              // псевдо-классы :not(:first-child) или :nth-child(even)
            'pseudo-cl'   => '~:[-a-z]+~',                       // псевдо-классы :first-letter или :first-line
            'delimiter'   => '~'.implode('|', $delimiter).'~',   // разделители
        );

        $this->hl();

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default']['f'].'">' . $this->code . '</pre>';

    }

    function highlightERP($code) {

        $this->init($code, 'erp');

        foreach ($this->settings[$this->lang]['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $this->pattern = array(
            'string'    => '~"[^"]*"~',  // строки
            'comment'   => '~\/\/.*$~m', // комментарии
            'object'    => '~(?<=Новый )[а-яa-z]+\b~ui', // создание объекта
            'keyword1'  => '~\b('.implode('|', $this->settings[$this->lang]['keyword1']).')\b~ui',  // ключевые слова
            'keyword2'  => '~\b('.implode('|', $this->settings[$this->lang]['keyword2']).')\b~ui',  // ключевые слова
            'keyword3'  => '~\b('.implode('|', $this->settings[$this->lang]['keyword3']).')\b~ui',  // ключевые слова
            'directive' => '~('.implode('|', $this->settings[$this->lang]['directive']).')~ui', // директивы компиляции
            'digit'     => '~\b\d+\b~', // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $this->hl();

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default']['f'].'">' . $this->code . '</pre>';
    }

    public function highlightHTML($code) {

        $this->init($code, 'html');

        $this->pattern = array(
            'entity'    => '~&[a-z]+;~',                  // html-сущности
            'attrname'  => '~(?<= )[-a-z0-9:]+(?=\=")~',  // имя атрибут тега
            'attrvalue' => '~(?<=\=)"[^"]*"(?=( |/|>))~', // значение атрибут тега
            //'equal'     => '~(?<=¤)\=(?=¤)~',             // разделитель между атрибутом и значением
            'element'   => '~</?[a-z0-9]+[^>]*>~',        // открывающие и закрывающие теги
            'comment'   => '~<\!--.*-->~',                // комментарии
            'doctype'   => '~<\!DOCTYPE[^>]*>~',          // <!DOCTYPE html>
        );

        $this->hl();

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default']['f'].'">' . $this->code . '</pre>';
    }

    public function highlightJS($code) {

        $this->init($code, 'js');

        foreach ($this->settings[$this->lang]['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $this->pattern = array(
            'string1'   => '~"[^"]*"~',   // строки в двойных кавычках
            'string2'   => "~'[^']*'~",   // строки в одинарных кавычках
            'comment1'  => '~\/\/.*$~m', // комментарии
            'comment2'  => '~/\*.*\*/~sU', // комментарии
            'keyword1'  => '~\b('.implode('|', $this->settings[$this->lang]['keyword1']).')\b~i', // ключевые слова
            'keyword2'  => '~\b('.implode('|', $this->settings[$this->lang]['keyword2']).')\b~i', // ключевые слова
            'function'  => '~\b('.implode('|', $this->settings[$this->lang]['function']).')\b\s?(?=\()~i', // встроенные функции
            'digit'     => '~\b\d+\b~', // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $this->hl();

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default']['f'].'">' . $this->code . '</pre>';

    }

    public function highlightPHP($code) {

        $this->init($code, 'php');

        foreach ($this->settings[$this->lang]['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $this->pattern = array(
            'string1'   => '~"[^"]*"~',   // строки в двойных кавычках
            'string2'   => "~'[^']*'~",   // строки в одинарных кавычках
            'comment1'  => '~\/\/.*$~m', // комментарии
            'comment2'  => '~/\*.*\*/~sU', // комментарии
            'keyword1'  => '~(?<!\$)\b('.implode('|', $this->settings[$this->lang]['keyword1']).')\b~i', // ключевые слова
            'keyword2'  => '~(?<!\$)\b('.implode('|', $this->settings[$this->lang]['keyword2']).')\b~i', // ключевые слова
            'keyword3'  => '~(?<!\$)\b('.implode('|', $this->settings[$this->lang]['keyword3']).')\b~i', // ключевые слова
            'function'  => '~(?<!\->)\b('.implode('|', $this->settings[$this->lang]['function']).')\b\s?(?=\()~i', // встроенные функции
            'constant'  => '~\b('.implode('|', $this->settings[$this->lang]['constant']).')\b~i', // встроенные контстанты
            'digit'     => '~\b\d+(\.\d+)?\b~', // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $this->hl();

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default']['f'].'">' . $this->code . '</pre>';

    }

    public function highlightPython($code) {

        $this->init($code, 'python');

        foreach ($this->settings[$this->lang]['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $this->pattern = array(
            'string3'   => '~""".*?"""~s',         // строки в тройных кавычках
            'string4'   => "~'''.*?'''~s",         // строки в тройных кавычках
            'string1'   => '~[ru]{0,2}"[^"]*"~',   // строки в двойных кавычках
            'string2'   => "~[ru]{0,2}'[^']*'~",   // строки в одинарных кавычках
            'comment'   => '~#.*$~m',              // комментарии
            'keyword1'  => '~\b('.implode('|', $this->settings[$this->lang]['keyword1']).')\b~i', // ключевые слова
            'keyword2'  => '~\b('.implode('|', $this->settings[$this->lang]['keyword2']).')\b~i', // ключевые слова
            'function'  => '~(?<!\.)('.implode('|', $this->settings[$this->lang]['function']).')(?=\()~i', // встроенные функции
            'digit'     => '~\b\d+\b~',            // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $this->hl();

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default']['f'].'">' . $this->code . '</pre>';

    }

    private function hl() {

        foreach ($this->pattern as $color => $regexp) {
            $offset = 0;
            while (preg_match($regexp, $this->code, $match, PREG_OFFSET_CAPTURE, $offset)) {

                $item = $match[0][0];
                $offset = $match[0][1];
                $length = strlen($match[0][0]);
                $tmp = str_replace(array('&', '>', '<'), array('&amp;', '&gt;', '&lt;'), $match[0][0]);
                $style = '';
                if (isset($this->settings[$this->lang]['colors'][$color]['f'], $this->settings[$this->lang]['colors'][$color]['b'])) {
                    $style = 'color:'.$this->settings[$this->lang]['colors'][$color]['f'] . '; background:' . $this->settings[$this->lang]['colors'][$color]['b'];
                } elseif (isset($this->settings[$this->lang]['colors'][$color]['f'])) {
                    $style = 'color:' . $this->settings[$this->lang]['colors'][$color]['f'];
                } elseif (isset($this->settings[$this->lang]['colors'][$color]['b'])) {
                    $style = 'background:' . $this->settings[$this->lang]['colors'][$color]['b'];
                }
                if (!empty($style)) {
                    $this->source[] = '<span style="' . $style . '">' . $tmp . '</span>';
                } else {
                    $this->source[] = $tmp;
                }
                $rand = '¤'.md5(uniqid(mt_rand(), true)).'¤';
                $this->replace[] = $rand;
                $this->code = substr_replace($this->code, $rand, $offset, $length);
                $offset = $offset + strlen($rand);

            }
        }

        $this->source = array_reverse($this->source);
        $this->replace = array_reverse($this->replace);

        if (!empty($this->source)) {
            $this->code = str_replace($this->replace, $this->source, $this->code);
        }

    }

    private function init($code, $lang) {

        $this->lang = $lang;

        $this->code = trim($code);
        $this->code = str_replace("\r\n", "\n", $this->code);
        $this->code = str_replace("\t", '    ', $this->code);

        $this->source = array();
        $this->replace = array();
        $this->pattern = array();

    }

    /**
     * Нумерация строк кода
     */
    private function number() {

        $lines = explode("\n", $this->code);
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
            $res[] = '<span style="color:'.$this->settings[$this->lang]['colors']['number'].'; font-size:12px">'.($num).'</span>  '.$line;
            $number++;
        }
        $this->code = implode("\r\n", $res);

    }
}