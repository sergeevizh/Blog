<?php
/**
 * Класс Highlight, для подсветки кода в публикациях
 */
class Highlight {

    private $settings = array(
        'apache' => array(
            'colors' => array(
                'default'  => array('fore' => '#0080FF'),
                'comment'  => array('fore' => '#888888'),
                'section'  => array('fore' => '#8000FF'),
                'param'    => array('fore' => '#008080'),
                'string'   => array('fore' => '#0000FF'),
            )
        ),
        'awk' => array(
            'colors' => array(
                'default'     => array('fore' => '#008080'),
                'comment'     => array('fore' => '#888888'),
                'string'      => array('fore' => '#0080FF'),
                'spec-var'    => array('fore' => '#808000'),
                '$variable'   => array('fore' => '#808000'),
                '$expression' => array('fore' => '#808000'),
                'keyword'     => array('fore' => '#8000FF'),
                'begin-end'   => array('fore' => '#800080'),
                'pattern'     => array('fore' => '#800080'),
                'digit'       => array('fore' => '#FF00FF'),
                'delimiter'   => array('fore' => '#FF0000'),
                'number'      => array('fore' => '#CCCCCC'),
            ),
            'keyword' => array(
                'if', 'else', 'for', 'in', 'while', 'do', 'break', 'continue', 'next', 'exit', 'return', 'printf', 'print', 'delete', 'function'
            ),
            'begin-end' => array(
                'BEGIN', 'END'
            ),
            'delimiter' => array(
                ',', ';', '=', '{', '}', '(', ')', '*', '+', '/', '-', '>', '<'
            ),
        ),
        'bash' => array(
            'colors' => array(
                'default'     => array('fore' => '#008080'),
                'bin-bash'    => array('fore' => '#888888', 'back' => '#FFFFFF'),
                'here-doc'    => array('fore' => '#BB00BB'),
                'comment1'    => array('fore' => '#888888'),
                'comment2'    => array('fore' => '#888888'),
                'comment3'    => array('fore' => '#888888'),
                'string1'     => array('fore' => '#0000DD'),
                'string2'     => array('fore' => '#0080FF'),
                'variable1'   => array('fore' => '#808000'),
                'variable2'   => array('fore' => '#808000'),
                'spec-var'    => array('fore' => '#808000'),
                'express'     => array('back' => '#FFF0F0'),
                'execute1'    => array('back' => '#FFFFEB'),
                'execute2'    => array('back' => '#FFFFFF'),
                'execute3'    => array('back' => '#FFFFFF'),
                'arr-init'    => array('back' => '#F5FFF5'),
                'function'    => array('fore' => '#CC22CC'),
                'keyword'     => array('fore' => '#8000FF'),
                'command'     => array('fore' => '#CC6600'),
                'signal'      => array('fore' => '#FF0000'),
                'number'      => array('fore' => '#CCCCCC'),
            ),
            'keyword' => array(
                'if', 'then', 'else', 'elif', 'fi', 'for', 'while', 'until', 'break', 'continue', 'in', 'do', 'done', 'case', 'esac', 'function', 'return', 'local', 'declare'
            ),
            'command' => array(
                'exit', 'exec', 'export', 'read', 'shift', 'sleep', 'wait', 'source', 'true', 'false', 'echo', 'set'
            ),
            'signal' => array(
                'SIGHUP', 'SIGINT', 'SIGQUIT', 'SIGKILL', 'SIGTERM', 'SIGCONT', 'SIGSTOP', 'SIGTSTP'
            ),
            'delimiter' => array(
                ';', '&&', '\|\|', '\[', '\]', '\(\(', '\)\)'
            ),
        ),
        'code' => array(
            'colors' => array(
                'default'   => array('fore'   => '#0080FF'),
                'selected1' => array('fore'   => '#EE0000'),
                'selected2' => array('fore'   => '#008080'),
                'selected3' => array('border' => '#FF0000'),
            ),
            'specchars' => array('&', '>', '<'),
        ),
        'cli' => array(
            'colors' => array(
                'default'   => array('fore' => '#0080FF'),
                'cliprompt' => array('fore' => '#AAAAAA'),
                'command'   => array('fore' => '#8000FF'),
                'comment'   => array('fore' => '#888888'),
                'selected1' => array('fore' => '#EE0000'),
                'selected2' => array('fore' => '#008080'),
            ),
            'specchars' => array('&', '>', '<'),
        ),
        'css' => array(
            'colors' => array(
                'default'     => array('fore' => '#008080'),
                'comment'     => array('fore' => '#888888'),
                'string'      => array('fore' => '#0000FF'),
                'import'      => array('fore' => '#EE00EE'),
                'media'       => array('fore' => '#EE00EE'),
                'prop-name'   => array('fore' => '#8000FF'),
                'prop-value'  => array('fore' => '#0080FF'),
                'css-uniq'    => array('fore' => '#8B008B'),
                'css-class'   => array('fore' => '#0000EE'),
                'pseudo-el'   => array('fore' => '#FF8000'),
                'pseudo-cl'   => array('fore' => '#FF8000'),
                'pseudo-cl-n' => array('fore' => '#FF8000'),
                'delimiter'   => array('fore' => '#FF0000'),
                'number'      => array('fore' => '#CCCCCC'),
            ),
            'function' => array('url', 'attr', 'calc', 'rgb'),
            'delimiter' => array('+', '~', ',', '>', ':', ';', '[', ']', '(', ')', '{', '}', '='),
        ),
        'erp' => array(
            'colors' => array(
                'default'   => array('fore' => '#008080'),
                'comment'   => array('fore' => '#888888'),
                'string'    => array('fore' => '#0000FF'),
                'keyword1'  => array('fore' => '#8B008B'),
                'keyword2'  => array('fore' => '#8000FF'),
                'keyword3'  => array('fore' => '#BB00BB'),
                'directive' => array('fore' => '#808000'),
                'code-area' => array('fore' => '#808000'),
                'datetime'  => array('fore' => '#DD00DD'),
                'digit'     => array('fore' => '#FF00FF'),
                'delimiter' => array('fore' => '#FF0000'),
                'function'  => array('fore' => '#0080FF'),
                'procedure' => array('fore' => '#0080FF'),
                'object'    => array('fore' => '#0080FF'),
                'number'    => array('fore' => '#CCCCCC'),
            ),
            'keyword1' => array(
                'Процедура', 'КонецПроцедуры', 'Функция', 'КонецФункции', 'Экспорт'
            ),
            'keyword2' => array(
                'Пока', 'Для', 'Каждого', 'По', 'Из', 'Цикл', 'КонецЦикла', 'Прервать', 'Продолжить', 'Если', 'Тогда', 'Иначе', 'ИначеЕсли', 'КонецЕсли', 'Попытка', 'Исключение', 'КонецПопытки', 'Новый', 'Возврат', 'Знач', 'Перем'
            ),
            'keyword3' => array(
                'Истина', 'Ложь', 'НЕ', 'И', 'ИЛИ', 'Неопределено'
            ),
            'directive' => array(
                '&НаКлиентеНаСервереБезКонтекста', '&НаСервереБезКонтекста', '&НаСервереНаКлиенте', '&НаКлиенте', '&НаСервере'
            ),
            'delimiter' => array(
                '=', ';', '.', '(', ')', '[', ']', ',', '+', '*', '-', '/', '!', '>', '<', '%', '?'
            ),
        ),
        'js' => array(
            'colors' => array(
                'default'   => array('fore' => '#008080'),
                'comment1'  => array('fore' => '#888888'),
                'comment2'  => array('fore' => '#888888'),
                'string1'   => array('fore' => '#0080FF'),
                'string2'   => array('fore' => '#0080FF'),
                'keyword1'  => array('fore' => '#8000FF'),
                'keyword2'  => array('fore' => '#DD00DD'),
                'function'  => array('fore' => '#990099'),
                'digit'     => array('fore' => '#DD00DD'),
                'delimiter' => array('fore' => '#FF5555'),
                'number'    => array('fore' => '#CCCCCC'),
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
        'html' => array(
            'colors' => array(
                'default'   => array('fore' => '#222222'),
                'doctype'   => array('fore' => '#8B008B'),
                'comment'   => array('fore' => '#888888'),
                'string'    => array('fore' => '#0080FF'),
                'element'   => array('fore' => '#008080'),
                'entity'    => array('fore' => '#8000FF'),
                'attrname'  => array('fore' => '#808000'),
                'attrvalue' => array('fore' => '#0080FF'),
                'equal'     => array('fore' => '#EE0000'),
                'number'    => array('fore' => '#CCCCCC'),
            ),
        ),
        'idle' => array(
            'colors' => array(
                'default'    => array('fore' => '#0080FF'),
                'idleprompt' => array('fore' => '#AAAAAA'),
                'command'    => array('fore' => '#8000FF'),
                'comment'    => array('fore' => '#888888'),
            ),
            'specchars' => array('&', '>', '<'),
        ),
        'ini' => array(
            'colors' => array(
                'default'  => array('fore' => '#0080FF'),
                'comment'  => array('fore' => '#888888'),
                'section'  => array('fore' => '#8000FF'),
                'param'    => array('fore' => '#008080'),
                'string'   => array('fore' => '#0000FF'),
                'equal'    => array('fore' => '#FF0000')
            )
        ),
        'php' => array(
            'colors' => array(
                'default'   => array('fore' => '#008080'),
                'startphp'  => array('fore' => '#FF0000'),
                'comment1'  => array('fore' => '#888888'),
                'comment2'  => array('fore' => '#888888'),
                'string1'   => array('fore' => '#0000EE'),
                'string2'   => array('fore' => '#0000FF'),
                'keyword1'  => array('fore' => '#8000FF'),
                'keyword2'  => array('fore' => '#808000'),
                'keyword3'  => array('fore' => '#DD00DD'),
                'function'  => array('fore' => '#0080FF'),
                'defined'   => array('fore' => '#FF6600'),
                'constant'  => array('fore' => '#AA00AA'),
                'digit'     => array('fore' => '#FF00FF'),
                'delimiter' => array('fore' => '#FF0000'),
                'number'    => array('fore' => '#CCCCCC'),
            ),
            'keyword1' => array(
                'if', 'else', 'elseif', 'for', 'while', 'foreach', 'as', 'break', 'continue', 'try', 'catch', 'finally', 'throw', 'return', 'switch', 'case', 'default', 'use', 'abstract', 'class', 'extends', 'function', 'public', 'protected', 'private', 'static', 'self', 'new', 'parent', 'const',  'array', 'list',
            ),
            'keyword2' => array(
                'echo', 'exit', 'die', 'require_once', 'require', 'include_once', 'include'
            ),
            'keyword3' => array(
                'true', 'false', 'null', 'int', 'float', 'bool'
            ),
            'function' => array(
                'echo', 'exit', 'die', 'require_once', 'require', 'include_once', 'include', 'isset', 'unset', 'implode', 'explode', 'get_class', 'lcfirst', 'ucfirst', 'iconv', 'empty', 'is_null', 'count', 'print_r', 'header', 'readfile', 'filesize', 'date', 'time', 'fopen', 'fsockopen', 'feof', 'fread', 'fwrite', 'fclose', 'urlencode', 'urldecode', 'file_get_contents', 'file_put_contents', 'md5', 'uniqid', 'move_uploaded_file', 'strlen', 'realpath', 'ctype_digit', 'file_exists', 'define', 'is_file', 'is_dir', 'basename', 'str_replace', 'fseek', 'filemtime', 'fpassthru'
            ),
            'defined' => array(
                '__LINE__', '__FILE__', '__DIR__', '__FUNCTION__', '__CLASS__', '__METHOD__', '__TRAIT__', 'DIRECTORY_SEPARATOR', 'PHP_EOL'
            ),
            'delimiter' => array(
                '.', ',', ':', ';', '=', '+', '-', '/', '*', '%', '[', ']', '(', ')', '{', '}', '>', '<', '|', '!', '?', '&', '@', '\\'
            ),
        ),
        'python' => array(
            'colors' => array(
                'default'   => array('fore' => '#008080'),
                'comment'   => array('fore' => '#888888'),
                'string1'   => array('fore' => '#0000FF'),
                'string2'   => array('fore' => '#0000FF'),
                'string3'   => array('fore' => '#0080FF'),
                'string4'   => array('fore' => '#0080FF'),
                'keyword1'  => array('fore' => '#8000FF'),
                'keyword2'  => array('fore' => '#DD00DD'),
                'function'  => array('fore' => '#0080FF'),
                'digit'     => array('fore' => '#FF00FF'),
                'delimiter' => array('fore' => '#FF0000'),
                'number'    => array('fore' => '#CCCCCC'),
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
        'query' => array(
            'colors' => array(
                'default'   => array('fore' => '#008080'),
                'comment'   => array('fore' => '#888888'),
                'string'    => array('fore' => '#0000FF'),
                'property'  => array('fore' => '#0080FF'),
                'keyword1'  => array('fore' => '#8000FF'),
                'keyword2'  => array('fore' => '#FF0080'),
                'function'  => array('fore' => '#808000'),
                'parameter' => array('fore' => '#DD00DD'),
                'digit'     => array('fore' => '#FF00FF'),
                'delimiter' => array('fore' => '#FF0000'),
                'number'    => array('fore' => '#CCCCCC'),
            ),
            'keyword1' => array(
                'ВЫБРАТЬ', 'ПЕРВЫЕ', 'РАЗЛИЧНЫЕ', 'РАЗРЕШЕННЫЕ', 'ПОМЕСТИТЬ', 'ИЗ', 'СОЕДИНЕНИЕ', 'ЛЕВОЕ', 'ПРАВОЕ', 'ПО', 'ГДЕ', 'В', 'ИЕРАРХИИ', 'МЕЖДУ', 'ПОДОБНО', 'ЕСТЬ', 'СГРУППИРОВАТЬ', 'ПО', 'УПОРЯДОЧИТЬ', 'ИМЕЮЩИЕ', 'ИТОГИ', 'КАК', 'ВЫБОР', 'КОГДА', 'ИНАЧЕ', 'КОНЕЦ', 'ТОЛЬКО', 'ИЕРАРХИЯ', 'ССЫЛКА', 'ОБЪЕДИНИТЬ', 'ВСЕ', 'И', 'ИЛИ', 'НЕ'
            ),
            'keyword2' => array(
                'ИСТИНА', 'ЛОЖЬ', 'NULL'
            ),
            'function'=> array(
                'СУММА', 'КОЛИЧЕСТВО', 'ЕСТЬNULL', 'ПРЕДСТАВЛЕНИЕ', 'ПРЕДСТАВЛЕНИЕССЫЛКИ', 'ВЫРАЗИТЬ', 'ЗНАЧЕНИЕ', 'РАЗНОСТЬДАТ', 'ДОБАВИТЬКДАТЕ', 'НАЧАЛОПЕРИОДА', 'КОНЕЦПЕРИОДА', 'ТИП', 'ТИПЗНАЧЕНИЯ', 'ВЫРАЗИТЬ'
            ),
            'delimiter' => array(
                '.', ',', '=', '(', ')', '{', '}', '>', '<', '!', '*'
            ),
        ),
        'xml' => array(
            'colors' => array(
                'default'   => array('fore' => '#222222'),
                'xmldecl'   => array('fore' => '#8B008B'),
                'comment'   => array('fore' => '#888888'),
                'element'   => array('fore' => '#008080'),
                'attrname'  => array('fore' => '#808000'),
                'attrvalue' => array('fore' => '#0080FF'),
                'entity'    => array('fore' => '#8000FF'),
                'number'    => array('fore' => '#CCCCCC'),
            ),
        )

    );

    private $lang = 'code', $source = array(), $replace = array(), $pattern = array();


    public function highlightApache($code) {

        $this->init($code, 'apache');

        $this->pattern = array(
            'comment' => '~^\s*#.*~m',              // комментарии
            'string'  => '~"[^"]*"~',               // строки в двойных кавычках
            'section' => '~\<[^>]+\>~',             // секция
            'param'   => '~^\s*[a-z]+(?= )~im',     // параметр
        );

        $this->hl();

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default']['fore'].'">' . $this->code . '</pre>';

    }

    public function highlightAWK($code) {

        $this->init($code, 'awk');

        foreach ($this->settings[$this->lang]['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }

        $this->pattern = array(
            'comment'     => '~# .*~',                    // комментарии
            'spec-var'    => '~\$[0-9]~',                 // позиционные переменные
            '$variable'   => '~\$[_a-z][_a-z0-9]*~',      // позиционные переменные
            '$expression' => '~\$\([^)]+\)~',             // позиционные переменные
            'string'      => '~"[^"]*"~',                 // строки в двойных кавычках
            'keyword'     => '~\b('.implode('|', $this->settings[$this->lang]['keyword']).')\b~',   // ключевые слова
            'begin-end'   => '~\b('.implode('|', $this->settings[$this->lang]['begin-end']).')\b~', // BEGIN и END
            'pattern'     => '~/[^/]+/~', // регулярное выражение
            'digit'       => '~\b\d+\b~', // цифры
            'delimiter'   => '~'.implode('|', $delimiter).'~', // разделители
        );

        $this->hl();

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default']['fore'].'">' . $this->code . '</pre>';

    }

    public function highlightBash($code) {

        $this->init($code, 'bash');

        $temp1 = array(
            'comment1'    => '~^ *#+$~m',                          // пустой комментарий
            'comment2'    => '~^ *#+ .*$~m',                       // комментарии от начала строки
            'comment3'    => '~(?<= )#+ .*~',                      // комментарии в конце строки
            'string1'     => "~'[^']*'~",                          // строки в одинарных кавычках
            'spec-var'    => '~\$([0-9]|#|!|\*|@|\$|\?)~i',        // специальные переменные
            'variable1'   => '~\$[a-z_][a-z0-9_]*~i',              // переменные
            'variable2'   => '~\$\{[^}]+\}?~i',                    // переменные
        );
        if (preg_match_all('~^[_a-z][_a-z0-9]*(?=\(\) \{)~im', $code, $matches)) {
            foreach($matches[0] as $match)
            $functions[] = $match;
        }
        if (preg_match_all('~(?<=function )[_a-z][_a-z0-9]*(?= \{)~i', $code, $matches)) {
            foreach($matches[0] as $match)
            $functions[] = $match;
        }
        $temp = array();
        if (!empty($functions)) {
            $temp['function'] = '~\b('.implode('|', $functions).')\b~';
        }
        $temp2 = array(
            'express'     => '~\$?\(\([^)(]+\)\)~',                // вычисление арифметического выражения
            'execute1'    => '~\$\([^)(]+\)~',                     // подстановка результата выполнения
            'execute2'    => '~\$\([^)(]+\)~',                     // подстановка результата выполнения
            'execute3'    => '~\`[^`]+`~',                         // подстановка результата выполнения
            'string2'     => '~"[^"]*"~',                          // строки в двойных кавычках
            'here-doc'    => '~(?<=\<\<) ?-?([-_A-Za-z]+).*?\1~s', // here doc
            'arr-init'    => '~(?<=[a-z]\=)\([^)]*\)~i',           // инициализация массива
            'keyword'     => '~\b('.implode('|', $this->settings[$this->lang]['keyword']).')\b~i', // ключевые слова
            'command'     => '~\b('.implode('|', $this->settings[$this->lang]['command']).')\b~i', // команды
            'signal'      => '~\b('.implode('|', $this->settings[$this->lang]['signal']).')\b~',   // сигналы
            'bin-bash'    => "~^#!/[-/a-z]+~",                      // что-то типа #!/bin/bash
        );

        $this->pattern = array_merge($temp1, $temp, $temp2);

        $this->hl();

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default']['fore'].'">' . $this->code . '</pre>';

    }

    public function highlightCLI($code) {

        $this->init($code, 'cli');

        foreach ($this->settings[$this->lang]['specchars'] as $value) {
            $specchars[] = '\\'.$value;
        }

        $this->pattern = array(
            'selected1' => '~\[red\].*?\[/red\]~',          // выделить текст
            'selected2' => '~\[grn\].*?\[/grn\]~',          // выделить текст
            'comment'   => '~(?<= )# .*$~m',                // комментарий
            'command'   => '~(?<=^(\$|\>) ).*$~m',          // команда
            'cliprompt' => '~^(\$|\>)(?= |$)~m',            // приглашение
            'specchars' => '~'.implode('|', $specchars).'~' // спец.символы
        );

        $this->hl();

        $this->code = str_replace(array('[red]', '[grn]', '[/red]', '[/grn]'), '', $this->code);

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default']['fore'].'">' . $this->code . '</pre>';

    }

    public function highlightCode($code) {

        $this->init($code, 'code');

        foreach ($this->settings[$this->lang]['specchars'] as $value) {
            $specchars[] = '\\'.$value;
        }

        $this->pattern = array(
            'selected1' => '~\[red\].*?\[/red\]~',          // выделить текст
            'selected2' => '~\[grn\].*?\[/grn\]~',          // выделить текст
            'selected3' => '~\[border\].*?\[/border\]~',    // выделить текст
            'specchars' => '~'.implode('|', $specchars).'~' // спец.символы
        );

        $this->hl();

        $this->code = str_replace(array('[red]', '[grn]', '[border]', '[/red]', '[/grn]', '[/border]'), '', $this->code);

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default']['fore'].'">' . $this->code . '</pre>';

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

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default']['fore'].'">' . $this->code . '</pre>';

    }

    public function highlightERP($code) {

        $this->init($code, 'erp');

        foreach ($this->settings[$this->lang]['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $this->pattern = array(
            'comment'   => '~\/\/.*$~m', // комментарии
            'string'    => '~"[^"]*"~',   // строки
            'object'    => '~(?<=Новый )[а-яa-z]+\b~ui', // создание объекта
            'function'  => '~(?<=Функция )[а-яa-z]+\b~ui', // объявление функции
            'procedure' => '~(?<=Процедура )[а-яa-z]+\b~ui', // объявление процедуры
            'keyword1'  => '~\b('.implode('|', $this->settings[$this->lang]['keyword1']).')\b~ui',  // ключевые слова
            'keyword2'  => '~\b('.implode('|', $this->settings[$this->lang]['keyword2']).')\b~ui',  // ключевые слова
            'keyword3'  => '~\b('.implode('|', $this->settings[$this->lang]['keyword3']).')\b~ui',  // ключевые слова
            'directive' => '~('.implode('|', $this->settings[$this->lang]['directive']).')~ui', // директивы компиляции
            'code-area' => '~#(Область|КонецОбласти).*$~umi', // области кода
            'datetime'  => "~'\d+'~", // дата и время
            'digit'     => '~\b\d+\b~u', // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $this->hl();

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default']['fore'].'">' . $this->code . '</pre>';

    }

    public function highlightHTML($code) {

        $this->init($code, 'html');

        $this->pattern = array(
            'entity'    => '~&[a-z]+;~',                  // html-сущности
            'attrname'  => '~(?<= )[-a-z0-9:]+(?=\=")~',  // имя атрибут тега
            'attrvalue' => '~(?<=\=)"[^"]*"(?=(\s|/|>))~', // значение атрибут тега
            //'equal'     => '~(?<=¤)\=(?=¤)~',             // разделитель между атрибутом и значением
            'element'   => '~</?[a-z0-9]+[^>]*>~',        // открывающие и закрывающие теги
            'comment'   => '~<\!--.*-->~',                // комментарии
            'doctype'   => '~<\!DOCTYPE[^>]*>~',          // <!DOCTYPE html>
        );

        $this->hl();

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default']['fore'].'">' . $this->code . '</pre>';
    }

    public function highlightJS($code) {

        $this->init($code, 'js');

        foreach ($this->settings[$this->lang]['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $this->pattern = array(
            'string1'   => '~"[^"]*"~',    // строки в двойных кавычках
            'string2'   => "~'[^']*'~",    // строки в одинарных кавычках
            'comment1'  => '~\/\/.*$~m',   // комментарии
            'comment2'  => '~/\*.*\*/~sU', // комментарии
            'keyword1'  => '~\b('.implode('|', $this->settings[$this->lang]['keyword1']).')\b~i', // ключевые слова
            'keyword2'  => '~\b('.implode('|', $this->settings[$this->lang]['keyword2']).')\b~i', // ключевые слова
            'function'  => '~\b('.implode('|', $this->settings[$this->lang]['function']).')\b\s?(?=\()~i', // встроенные функции
            'digit'     => '~\b\d+\b~', // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $this->hl();

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default']['fore'].'">' . $this->code . '</pre>';

    }

    public function highlightIDLE($code) {

        $this->init($code, 'idle');

        foreach ($this->settings[$this->lang]['specchars'] as $value) {
            $specchars[] = '\\'.$value;
        }

        $this->pattern = array(
            'comment'    => '~(?<= )# .*$~m',                // комментарий
            'command'    => '~(?<=^(\>{3}|\.{3}) ).*$~m',    // команда
            'idleprompt' => '~^(>{3}|\.{3})(?= )~m',         // приглашение
            'specchars'  => '~'.implode('|', $specchars).'~' // спец.символы
        );

        $this->hl();

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default']['fore'].'">' . $this->code . '</pre>';

    }

    public function highlightINI($code) {

        $this->init($code, 'ini');

        $this->pattern = array(
            'comment' => '~^;.*~m',              // комментарии
            'string'  => '~"[^"]*"~',            // строки в двойных кавычках
            'section' => '~^\[[_a-z0-9]+\]~mi',  // начало секции
            'param'   => '~^[_a-z.]+(?= =)~im',  // параметр
            'equal'   => '~(?<= )=(?=( |$))~',   // знак =
        );

        $this->hl();

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default']['fore'].'">' . $this->code . '</pre>';

    }

    public function highlightPHP($code) {

        $this->init($code, 'php');

        foreach ($this->settings[$this->lang]['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $this->pattern = array(
            'startphp'  => '~<\?php~',     // начало php-кода
            
            'string1'   => '~"[^"]*"~',    // строки в двойных кавычках
            'string2'   => "~'[^']*'~",    // строки в одинарных кавычках
            'comment1'  => '~\/\/.*$~m',   // комментарии
            'comment2'  => '~/\*.*\*/~sU', // комментарии
            'keyword1'  => '~(?<!\$)\b('.implode('|', $this->settings[$this->lang]['keyword1']).')\b~i', // ключевые слова
            'keyword2'  => '~(?<!\$)\b('.implode('|', $this->settings[$this->lang]['keyword2']).')\b~i', // ключевые слова
            'keyword3'  => '~(?<!\$)\b('.implode('|', $this->settings[$this->lang]['keyword3']).')\b~i', // ключевые слова
            'function'  => '~(?<!\->)\b('.implode('|', $this->settings[$this->lang]['function']).')\b\s?(?=\()~i', // встроенные функции
            'defined'   => '~\b('.implode('|', $this->settings[$this->lang]['defined']).')\b~i', // встроенные контстанты
            'constant'  => '~(?<!\$)\b([_A-Z]+)\b~', // контстанты
            'digit'     => '~\b\d+(\.\d+)?\b~', // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $this->replaceQuoteInString();
        $this->hl();
        $this->code = str_replace(chr(19), '"', $this->code);
        $this->code = str_replace(chr(20), "'", $this->code);

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default']['fore'].'">' . $this->code . '</pre>';

    }

    public function highlightPHTML($code) {
        ini_set('highlight.string',  '#0000FF');
        ini_set('highlight.comment', '#888888');
        ini_set('highlight.keyword', '#FF0000');
        ini_set('highlight.default', '#008080');
        ini_set('highlight.html',    '#0080FF');
        $html = '<div class="phtml">'.highlight_string(trim($code), true).'</div>';
        return str_replace(
            array('&lt;?php', '&lt;?=', '?&gt;'),
            array(
                '<span style="background:#FFFFEE;">&lt;?php</span>',
                '<span style="background:#FFFFEE;">&lt;?=</span>',
                '<span style="background:#FFFFEE;">?&gt;</span>'
            ),
            $html
        );
    }

    public function highlightPython($code) {

        $this->init($code, 'python');

        foreach ($this->settings[$this->lang]['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $this->pattern = array(
            'comment'   => '~# .*$~m',             // комментарии
            'string3'   => '~""".*?"""~s',         // строки в тройных кавычках
            'string4'   => "~'''.*?'''~s",         // строки в тройных кавычках
            'string1'   => '~[ru]{0,2}"[^"]*"~',   // строки в двойных кавычках
            'string2'   => "~[ru]{0,2}'[^']*'~",   // строки в одинарных кавычках
            'keyword1'  => '~\b('.implode('|', $this->settings[$this->lang]['keyword1']).')\b~i', // ключевые слова
            'keyword2'  => '~\b('.implode('|', $this->settings[$this->lang]['keyword2']).')\b~i', // ключевые слова
            'function'  => '~(?<!\.)\b('.implode('|', $this->settings[$this->lang]['function']).')(?=\()~i', // встроенные функции
            'digit'     => '~\b\d+\b~',            // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $this->hl();

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default']['fore'].'">' . $this->code . '</pre>';

    }

    public function highlightQuery($code) {

        $this->init($code, 'query');

        foreach ($this->settings[$this->lang]['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $this->pattern = array(
            'string'    => '~"[^"]*"~',  // строки
            'comment'   => '~\/\/.*$~m', // комментарии
            'property'  => '~(?<=\{)[^}{]*(?=\})~',   // характеристики
            'keyword1'  => '~\b('.implode('|', $this->settings[$this->lang]['keyword1']).')\b(?= |$)~mu',  // ключевые слова
            'keyword2'  => '~\b('.implode('|', $this->settings[$this->lang]['keyword2']).')\b(?= |$)~mui', // ключевые слова
            'function'  => '~\b('.implode('|', $this->settings[$this->lang]['function']).')(?=\()~ui', // функции
            'parameter' => '~&[а-яё]+\b~ui', // параметр
            'digit'     => '~\b\d+\b~', // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $this->hl();

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default']['fore'].'">' . $this->code . '</pre>';

    }

    public function highlightXML($code) {

        $this->init($code, 'xml');

        $this->pattern = array(
            'xmldecl'   => '~<\?xml[^>]*>~',                       // <?xml version="1.0" encoding="utf-8"...>
            'comment'   => '~<\!--.*-->~',                         // комментарии
            'attrname'  => '~(?<= )[-a-zA-Zа-яА-Я0-9:]+(?=\=")~u', // имя атрибут тега
            'attrvalue' => '~(?<=\=)"[^"]*"(?=(\s|/|>))~',         // значение атрибут тега
            'element'   => '~</?[a-zA-Zа-яА-Я0-9]+[^>]*>~u',       // открывающие и закрывающие теги
            'entity'    => '~&[a-z]+;~',                           // html-сущности
        );

        $this->hl();

        return '<pre style="color:'.$this->settings[$this->lang]['colors']['default']['fore'].'">' . $this->code . '</pre>';
    }

    private function hl() {

        foreach ($this->pattern as $color => $regexp) {

            $offset = 0;
            while (preg_match($regexp, $this->code, $match, PREG_OFFSET_CAPTURE, $offset)) {

                $item = $match[0][0];
                $offset = $match[0][1];
                $length = strlen($match[0][0]);
                $tmp = str_replace(array('&', '>', '<'), array('&amp;', '&gt;', '&lt;'), $match[0][0]);

                // TODO: оформить этот хак по-человечески
                if ($this->lang == 'erp' && $color == 'string' && '"ВЫБРАТЬ' == iconv_substr($tmp, 0, 8)) {
                    $tmp = preg_replace(
                        '~\b('.implode('|', $this->settings['query']['keyword1']).')\b(?= |$)~mu',
                        '<span style="color:#0000AA">$0</span>',
                        $tmp
                    );
                    $tmp = preg_replace(
                        '~\b('.implode('|', $this->settings['query']['function']).')(?=\()~ui',
                        '<span style="color:#0000AA">$0</span>',
                        $tmp
                    );

                }

                $styles = array();
                if (isset($this->settings[$this->lang]['colors'][$color]['fore'])) {
                    $styles[] = 'color:'.$this->settings[$this->lang]['colors'][$color]['fore'];
                }
                if (isset($this->settings[$this->lang]['colors'][$color]['back'])) {
                    $styles[] = 'background:'.$this->settings[$this->lang]['colors'][$color]['back'];
                }
                if (isset($this->settings[$this->lang]['colors'][$color]['border'])) {
                    $styles[] = 'border:1px solid '.$this->settings[$this->lang]['colors'][$color]['border'];
                }
                $style = '';
                if (!empty($styles)) {
                    $style = implode(';', $styles);
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
    
    /**
     * Заменяет двойную/одинарную кавычку внутри строки в одинарных/двойных кавычках
     */
    private function replaceQuoteInString() {
        
        /*
         * ищем двойную кавычку внутри строки в одинарных кавычках
         */
        // ищем позиции, которые занимают в строке кода символы строки в одинарных кавычках
        $positions = array();
        $offset = 0;
        $i = 0;
        while(false !== $pos = strpos($this->code, "'", $offset)) {
            if ($i % 2) {
                $stop = $pos;
                for ($j = $start; $j <= $stop; $j++) {
                    $positions[] = $j;
                }
            } else {
                $start = $pos;
            }
            $offset = $pos + 1;
            $i++;
        }

        // теперь проверяем, входит ли позиция двойной кавычки в массив $positions
        $offset = 0;
        while(false !== $pos = strpos($this->code, '"', $offset)) {
            
            if (in_array($pos, $positions)) {
                $this->code = substr_replace($this->code, chr(19), $pos, 1);
            }
            $offset = $pos + 1;
        }

        /*
         * ищем одинарную кавычку внутри строки в двойных кавычках
         */
        // ищем позиции, которые занимают в строке кода символы строки в двойных кавычках
        $positions = array();
        $offset = 0;
        $i = 0;
        while(false !== $pos = strpos($this->code, '"', $offset)) {
            if ($i % 2) {
                $stop = $pos;
                for ($j = $start; $j <= $stop; $j++) {
                    $positions[] = $j;
                }
            } else {
                $start = $pos;
            }
            $offset = $pos + 1;
            $i++;
            if ($i > 5) break;
        }
        // print_r($positions);
        // теперь проверяем, входит ли позиция одинарной кавычки в массив $positions
        $offset = 0;
        while(false !== $pos = strpos($this->code, "'", $offset)) {
            if (in_array($pos, $positions)) {
                $this->code = substr_replace($this->code, chr(20), $pos, 1);
            }
            $offset = $pos + 1;
        }       

    }
}