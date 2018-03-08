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
                'string3'   => '#8000FF',
                'string4'   => '#8000FF',
                'delimiter' => '#FF0000',
                'digit'     => '#FF00FF',
                'number'    => '#CCCCCC',
                'keyword1'  => '#8B008B',
                'keyword2'  => '#DF7000',
                'keyword3'  => '#8000FF',
            ),
            'keyword1' => array(
                'def', 'if', 'else', 'elif', 'for', 'while', 'break', 'continue', 'del', 'try', 'except', 'raise', 'finally', 'from', 'import', 'return', 'pass', 'lambda'
            ),
            'keyword2' => array(
                'True', 'False', 'None'
            ),
            'keyword3' => array(
                'in', 'not', 'and', 'or', 'is'
            ),
            'delimiter' => array(
                '.', ',', ':', '=', '+', '-', '/', '*', '%', '[', ']', '(', ')', '{', '}'
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
            'string3'   => '~""".*"""~s',   // строки в тройных кавычках
            'string4'   => "~'''.*'''~s",   // строки в тройных кавычках
            'string1'   => '~r?"[^"]*"~',   // строки в двойных кавычках
            'string2'   => "~r?'[^']*'~",   // строки в одинарных кавычках
            'keyword1'  => '~\b('.implode('|', $this->settings[$this->lang]['keyword1']).')\b~i', // ключевые слова
            'keyword2'  => '~\b('.implode('|', $this->settings[$this->lang]['keyword2']).')\b~i', // ключевые слова
            'keyword3'  => '~\b('.implode('|', $this->settings[$this->lang]['keyword3']).')\b~i', // ключевые слова
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
                    $this->source[] = '<span style="color:'.$this->settings[$this->lang]['colors'][$color].'">' . $item . '</span>';
                    $rand = '¤'.md5(uniqid(mt_rand(), true)).'¤';
                    $this->replace[] = $rand;
                    $this->code = preg_replace($regexp, $rand, $this->code, 1);
                }
            }
        }

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
            $res[] = '<span style="color:'.$this->settings[$this->lang]['colors']['number'].'">'.($num).'</span> '.$line;
            $number++;
        }
        $this->code = implode("\r\n", $res);
    }
}