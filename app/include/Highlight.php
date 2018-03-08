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
                'keyword2'  => '#8000FF',
            ),
            'keyword1' => array(
                'def', 'if', 'else', 'elif', 'for', 'while', 'break', 'continue', 'in', 'not', 'del', 'try', 'except', 'raise', 'finally', 'from', 'import', 'return', 'and', 'or', 'is', 'pass', 'lambda'
            ),
            'keyword2' => array(
                'True', 'False', 'None'
            ),
            'delimiter' => array(
                '.', ',', ':', '=', '+', '-', '/', '*', '%', '[', ']', '(', ')', '{', '}'
            ),
        )
    ); 

    public function highlightPython($code) {

        $code = trim($code);
        $code = str_replace("\r\n", "\n", $code);
        $code = str_replace("\t", '    ', $code); // замена табуляции на 4 пробела

        $source = array();
        $replace = array();
        
        foreach ($this->settings['python']['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $pattern = array(
            'comment'   => '~#.*$~m',     // комментарии
            'string3'   => '~""".*"""~s', // строки в тройных кавычках
            'string4'   => "~'''.*'''~s", // строки в тройных кавычках
            'string1'   => '~"[^"]*"~',   // строки в двойных кавычках
            'string2'   => "~'[^']*'~",   // строки в одинарных кавычках
            'keyword1'  => '~ '.implode('|', $this->settings['python']['keyword1']).' ~i', // ключевые слова
            'keyword2'  => '~ '.implode('|', $this->settings['python']['keyword2']).' ~i', // ключевые слова
            'delimiter' => '~'.implode('|', $delimiter).'~',   // разделители
            'digit'     => '~\b\d+\b~', // цифры
        );
        
        $this->replaceSourceWithString($code, $pattern, $source, $replace);

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
            $res[] = '<span style="color:'.$this->settings['python']['colors']['number'].'">'.($num).'</span> '.$line;
            $number++;
        }
        $code = implode("\r\n", $res);

        return '<pre style="color:'.$this->settings['python']['colors']['default'].'">'.$code.'</pre>';
    }

    
    private function replaceSourceWithString(&$code, $pattern, &$source, &$replace) {
        foreach ($pattern as $color => $regexp) {
            if (preg_match_all($regexp, $code, $matches)) {
                foreach($matches[0] as $item) {
                    $source[] = '<span style="color:'.$this->settings['python']['colors'][$color].'">' . $item . '</span>';
                    $rand = '¤'.md5(uniqid(mt_rand(), true)).'¤';
                    $replace[] = $rand;
                    // заменяем только первое вхождение
                    $strpos = strpos($code, $item);
                    $code = substr_replace($code, $rand, $strpos, strlen($item));
                }
            }
        }
        /*
        $temp = array();
        $delimiters = $this->settings['python']['delimiter'];
        foreach ($delimiters as $delimiter) {
            $source[] = '<span style="color:'.$this->settings['python']['colors']['delimiter'].'">' . $delimiter . '</span>';
            $rand = '¤'.md5(uniqid(mt_rand(), true)).'¤';
            $replace[] = $rand;
            $code = str_replace($delimiter, $rand, $code);
        }
        */
        if (!empty($source)) {
            $code = str_replace($replace, $source, $code);
        }
    }
    
    private function replaceStringWithSource($string, $replace) {
    
    }
}