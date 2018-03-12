<?php
/**
 * Класс Highlight, для подсветки кода в публикациях
 */
class Highlight {

    private $settings = array(
        'bash' => array(
            'colors' => array(
                'default'   => '#008080',
                'variable'  => '#808000',
                'comment'   => '#888888',
                'string1'   => '#0000FF',
                'string2'   => '#0080FF',
                'varinstr'  => '#008080',
                'keyword'   => '#DD0000',
                'delimiter' => '#FF0000',
                'number'    => '#CCCCCC',
            ),
            'keyword' => array(
                'if', 'else', 'elif', 'fi', 'for', 'while', 'until', 'break', 'continue', 'in', 'do', 'done', 'case', 'esac', 'exit'
            ),
            'delimiter' => array(
                '.', ',', ':', ';', '=', '+', '-', '/', '*', '%', '[', ']', '(', ')', '{', '}', '>', '<', '|', '!'
            ),
        ),
        'erp' => array(
            'colors' => array(
                'default'   => '#008080',
                'comment'   => '#888888',
                'string'    => '#0000FF',
                'keyword1'  => '#8B008B',
                'keyword2'  => '#CD3700',
                'keyword3'  => '#8000FF',
                'directive' => '#808000',
                'digit'     => '#FF00FF',
                'delimiter' => '#FF0000',
                'object'    => '#0080FF',
                'number'    => '#CCCCCC'
            ),
            'keyword1' => array(
                'Процедура', 'КонецПроцедуры', 'Функция', 'КонецФункции', 'Возврат', 'Экспорт', 'Знач', 'Перем', 'Новый'
            ),
            'keyword2' => array(
                'Пока', 'Для', 'Каждого', 'Из', 'Цикл', 'КонецЦикла', 'Прервать', 'Продолжить', 'Если', 'Тогда', 'Иначе', 'ИначеЕсли', 'КонецЕсли', 'Попытка', 'Исключение', 'КонецПопытки'
            ),
            'keyword3' => array(
                'Истина', 'Ложь', 'НЕ', 'И', 'ИЛИ'
            ),
            'delimiter' => array(
                '=', ';', '.', '(', ')', '[', ']', ',', '+', '*', '-', '/', '!', '>', '<', '%'
            ),
            'directive' => array(
                '&НаКлиенте', '&НаСервере', '&НаСервереБезКонтекста', '&НаСервереНаКлиенте', '&НаКлиентеНаСервереБезКонтекста'
            )
        ),
        'python' => array(
            'colors' => array(
                'default'   => '#008080',
                'comment'   => '#888888',
                'string1'   => '#0000FF',
                'string2'   => '#0000FF',
                'string3'   => '#0080FF',
                'string4'   => '#0080FF',
                'keyword1'  => '#DD0000',
                'keyword2'  => '#808000',
                'keyword3'  => '#8000FF',
                'function'  => '#0080FF',
                'digit'     => '#FF00FF',
                'delimiter' => '#FF0000',
                'number'    => '#CCCCCC',
            ),
            'keyword1' => array(
                'def', 'if', 'else', 'elif', 'for', 'while', 'break', 'continue', 'del', 'try', 'except', 'raise', 'finally', 'from', 'import', 'return', 'pass', 'lambda', 'with', 'as'
            ),
            'keyword2' => array(
                'True', 'False', 'None'
            ),
            'keyword3' => array(
                'in', 'not', 'and', 'or', 'is'
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
                'default'   => '#222222',
                'doctype'   => '#8B008B',
                'comment'   => '#888888',
                'string'    => '#0080FF',
                'element'   => '#008080',
                'entity'    => '#8000FF',
                'attrname'  => '#808000',
                'attrvalue' => '#0080FF',
                'equal'     => '#EE0000',
                'number'    => '#CCCCCC',
            ),
        )
    );

    private $lang = 'code', $source = array(), $replace = array(), $pattern = array();

    public function highlightBash($code) {

        $this->init($code, 'bash');

        foreach ($this->settings[$this->lang]['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $this->pattern = array(
            'variable'  => '~\$[a-z]+~i', // переменные
            'string1'   => '~"[^"]*"~',   // строки в двойных кавычках
            'string2'   => "~'[^']*'~",   // строки в одинарных кавычках
            'comment'   => '~#.*$~m',     // комментарии
            'keyword'   => '~\b('.implode('|', $this->settings[$this->lang]['keyword']).')\b~i', // ключевые слова
            'digit'     => '~\b\d+\b~', // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $this->hl();

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default'].'">' . $this->code . '</pre>';

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
            'directive' => '~\b('.implode('|', $this->settings[$this->lang]['directive']).')\b~ui', // директивы компиляции
            'digit'     => '~\b\d+\b~', // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $this->hl();

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default'].'">' . $this->code . '</pre>';
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

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default'].'">' . $this->code . '</pre>';
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
            'keyword3'  => '~\b('.implode('|', $this->settings[$this->lang]['keyword3']).')\b~i', // ключевые слова
            'function'  => '~(?<!\.)('.implode('|', $this->settings[$this->lang]['function']).')(?=\()~i', // встроенные функции
            'digit'     => '~\b\d+\b~', // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $this->hl();

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default'].'">' . $this->code . '</pre>';

    }

    private function hl() {

        foreach ($this->pattern as $color => $regexp) {
            if (preg_match_all($regexp, $this->code, $matches)) {
            // if ($color == 'attrname' || $color == 'attrvalue') print_r($matches);
                foreach($matches[0] as $item) {
                    $item = str_replace(array('&', '>', '<'), array('&amp;', '&gt;', '&lt;'), $item);
                    /*
                    if ($item == '>') {
                        $item = '&gt;';
                    }
                    if ($item == '<') {
                        $item = '&lt;';
                    }
                    */
                    $this->source[] = '<span style="color:'.$this->settings[$this->lang]['colors'][$color].'">' . $item . '</span>';
                    $rand = '¤'.md5(uniqid(mt_rand(), true)).'¤';
                    $this->replace[] = $rand;
                    $this->code = preg_replace($regexp, $rand, $this->code, 1);
                }
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