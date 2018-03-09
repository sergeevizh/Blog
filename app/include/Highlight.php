<?php
/**
 * Класс Highlight, для подсветки кода в публикациях
 */
class Highlight {

    private $settings = array(
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
        )
    );

    private $lang = 'code', $source = array(), $replace = array(), $pattern = array();


    public function highlightPython($code) {

        $this->init($code, 'python');

        foreach ($this->settings[$this->lang]['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $this->pattern = array(
            'comment'   => '~#.*$~m',       // комментарии
            'string3'   => '~""".*?"""~s',  // строки в тройных кавычках
            'string4'   => "~'''.*?'''~s",  // строки в тройных кавычках
            'string1'   => '~r?"[^"]*"~',   // строки в двойных кавычках
            'string2'   => "~r?'[^']*'~",   // строки в одинарных кавычках
            'keyword1'  => '~\b('.implode('|', $this->settings[$this->lang]['keyword1']).')\b~i', // ключевые слова
            'keyword2'  => '~\b('.implode('|', $this->settings[$this->lang]['keyword2']).')\b~i', // ключевые слова
            'keyword3'  => '~\b('.implode('|', $this->settings[$this->lang]['keyword3']).')\b~i', // ключевые слова
            'function'  => '~(?<!\.)('.implode('|', $this->settings[$this->lang]['function']).')(?=\()~i', // встроенные функции
            'digit'     => '~\b\d+\b~', // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~',   // разделители
        );

        $this->hl();

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default'].'">' . $this->code . '</pre>';

    }


    private function hl() {

        foreach ($this->pattern as $color => $regexp) {
            if (preg_match_all($regexp, $this->code, $matches)) {
                foreach($matches[0] as $item) {
                    if ($item == '>') {
                        $item = '&gt;';
                    }
                    if ($item == '<') {
                        $item = '&lt;';
                    }
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