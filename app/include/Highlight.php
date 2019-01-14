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
                'vars'     => array('fore' => '#808000'),
                'string'   => array('fore' => '#0000FF'),
                'section'  => array('fore' => '#8000FF'),
                'param'    => array('fore' => '#008080'),
                'flags'    => array('fore' => '#CC6600'),
                'regexp1'  => array('fore' => '#CC0099'),
                'regexp2'  => array('fore' => '#CC0099'),
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
                'function'    => array('fore' => '#AA00AA'),
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
                'url-cont'    => array('fore' => '#0000FF'),
                'important'   => array('fore' => '#FF8080'),
                'string'      => array('fore' => '#0000FF'),
                'rules'       => array('fore' => '#EE00EE'),
                'css-var'     => array('fore' => '#00AA00'),
                'prop-name'   => array('fore' => '#0080C0'),
                'prop-value'  => array('fore' => '#808000'),
                'css-uniq'    => array('fore' => '#8000FF'),
                'css-class'   => array('fore' => '#0080FF'),
                'pseudo'      => array('fore' => '#CC6600'),
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
                'area-name' => array('fore' => '#0080FF'),
                'datetime'  => array('fore' => '#DD00DD'),
                // 'object'    => array('fore' => '#0080FF'),
                // 'function'  => array('fore' => '#0080FF'),
                // 'procedure' => array('fore' => '#0080FF'),
                'def-call'  => array('fore' => '#0080C0'),
                'digit'     => array('fore' => '#FF00FF'),
                'delimiter' => array('fore' => '#FF0000'),
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
                'string1'   => array('fore' => '#0000FF'),
                'string2'   => array('fore' => '#0000FF'),
                'regexp'    => array('fore' => '#EE8000'),
                'keyword1'  => array('fore' => '#8000FF'),
                'keyword2'  => array('fore' => '#808000'),
                //'def-call'  => array('fore' => '#808040'),
                'digit'     => array('fore' => '#FF00FF'),
                'delimiter' => array('fore' => '#FF0000'),
                'number'    => array('fore' => '#CCCCCC'),
            ),
            'keyword1' => array(
                'if', 'else', 'elseif', 'for', 'while', 'foreach', 'as', 'break', 'continue', 'return', 'switch', 'case', 'default', 'do', 'with', 'in', 'abstract', 'class', 'extends', 'function', 'final', 'public', 'protected', 'private', 'static', 'self', 'new', 'instanceof', 'interface', 'this', 'try', 'throw', 'throws', 'finally', 'implements', 'super', 'var',  'typeof', 'void'
            ),
            'keyword2' => array(
                'true', 'false', 'boolean', 'int', 'float', 'undefined', 'null'
            ),
            'delimiter' => array(
                '.', ',', ':', ';', '=', '+', '-', '/', '*', '%', '[', ']', '(', ')', '{', '}', '>', '<', '|', '!', '?', '&'
            ),
        ),
        'json' => array(
            'colors' => array(
                'default'   => array('fore' => '#000000'),
                'string'    => array('fore' => '#0080FF'),
                'null'      => array('fore' => '#808000'),
                'bool'      => array('fore' => '#FF8000'),
                'digit'     => array('fore' => '#EE00EE'),
                'delimiter' => array('fore' => '#FF0000'),
                'number'    => array('fore' => '#CCCCCC'),
            ),
            'delimiter' => array(
                ',', '.', ':', '[', ']', '{', '}'
            ),
        ),
        'html' => array(
            'colors' => array(
                'default'   => array('fore' => '#333333'),
                'doctype'   => array('fore' => '#0080C0', 'back' => '#FFFFFF'),
                'comment'   => array('fore' => '#888888'),
                'string'    => array('fore' => '#0080FF'),
                'element'   => array('fore' => '#0080C0'),
                'entity'    => array('fore' => '#8000FF'),
                'attrname'  => array('fore' => '#808000'),
                'attrval1'  => array('fore' => '#0080FF'),
                'attrval2'  => array('fore' => '#0080FF'),
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
        'less' => array(
            'colors' => array(
                'default'     => array('fore' => '#008080'),
                'comment1'    => array('fore' => '#888888'),
                'comment2'    => array('fore' => '#888888'),
                'url-cont'    => array('fore' => '#0000FF'),
                'important'   => array('fore' => '#FF8080'),
                'string'      => array('fore' => '#0000FF'),
                'rules'       => array('fore' => '#EE00EE'),
                'less-var'    => array('fore' => '#00AA00', 'back' => '#FFFFEE'),
                'css-var'     => array('fore' => '#00AA00'),
                'prop-name'   => array('fore' => '#0080C0'),
                'prop-value'  => array('fore' => '#808000'),
                'css-uniq'    => array('fore' => '#8000FF'),
                'css-class'   => array('fore' => '#0080FF'),
                'pseudo'      => array('fore' => '#CC6600'),
                'delimiter'   => array('fore' => '#FF0000'),
                'number'      => array('fore' => '#CCCCCC'),
            ),
            'function' => array('url', 'attr', 'calc', 'rgb'),
            'delimiter' => array('+', '~', ',', '>', ':', ';', '[', ']', '(', ')', '{', '}', '='),
        ),
        'mysql' => array(
            'colors' => array(
                'default'  => array('fore' => '#8000FF'),
                'comment1' => array('fore' => '#888888'),
                'comment2' => array('fore' => '#888888'),
                'comment3' => array('fore' => '#888888'),
                'string1'  => array('fore' => '#0080FF'),
                'string2'  => array('fore' => '#0080FF'),
                'string3'  => array('fore' => '#0080C0'),
                'type'     => array('fore' => '#808000'),
                'value'    => array('fore' => '#CC6600'),
                'digit'    => array('fore' => '#DD00DD'),
                'delimiter'=> array('fore' => '#FF0000'),
            ),
            'type' => array(
                'TINYINT', 'SMALLINT', 'MEDIUMINT', 'INTEGER', 'BIGINT', 'INT', 'FLOAT', 'DOUBLE', 'REAL', 'DECIMAL', 'NUMERIC', 'BIT', 'YEAR', 'DATETIME', 'DATE', 'TIMESTAMP', 'TIME', 'VARCHAR', 'CHAR', 'VARBINARY', 'BINARY', 'TINYBLOB', 'MEDIUMBLOB', 'LONGBLOB', 'BLOB', 'TINYTEXT', 'MEDIUMTEXT', 'LONGTEXT', 'TEXT', 'ENUM'
            ),
            'delimiter' => array(
                '.', ',', ';', '=', '(', ')', '@', '*', '>', '<'
            ),
        ),
        'php' => array(
            'colors' => array(
                'default'   => array('fore' => '#008080'),
                'startphp'  => array('fore' => '#FF0000', 'back' => '#FFFFEE'),
                'shortphp'  => array('fore' => '#FF0000', 'back' => '#FFFFEE'),
                'startecho' => array('fore' => '#FF0000', 'back' => '#FFFFEE'),
                'stopphp'   => array('fore' => '#FF0000', 'back' => '#FFFFEE'),
                'comment1'  => array('fore' => '#888888'),
                'comment2'  => array('fore' => '#888888'),
                'string1'   => array('fore' => '#0000EE'),
                'string2'   => array('fore' => '#0000FF'),
                'keyword1'  => array('fore' => '#8000FF'),
                'keyword2'  => array('fore' => '#808000'),
                'keyword3'  => array('fore' => '#CC6600'),
                'function'  => array('fore' => '#0080FF'),
                'def-call'  => array('fore' => '#0080C0'),
                'defined'   => array('fore' => '#CC00CC'),
                'constant'  => array('fore' => '#990099'),
                'super-arr' => array('fore' => '#00AA00'),
                'digit'     => array('fore' => '#FF00FF'),
                'delimiter' => array('fore' => '#FF0000'),
                'number'    => array('fore' => '#CCCCCC'),
            ),
            'keyword1' => array(
                'if', 'else', 'elseif', 'endif', 'for', 'endfor', 'while', 'endwhile', 'foreach', 'endforeach', 'as', 'break', 'continue', 'try', 'catch', 'finally', 'throw', 'return', 'switch', 'case', 'default', 'namespace', 'use', 'abstract', 'class', 'extends', 'implements', 'function', 'public', 'protected', 'private', 'static', 'self', 'new', 'parent', 'const', 'array', 'int', 'float', 'bool', 'mixed',  'string', 'object', 'list', 'global'
            ),
            'keyword2' => array(
                'echo', 'exit', 'die', 'require_once', 'require', 'include_once', 'include'
            ),
            'keyword3' => array(
                'true', 'false', 'null'
            ),
            'function' => array(
                'echo', 'exit', 'die', 'require_once', 'require', 'include_once', 'include', 'isset', 'unset', 'implode', 'explode', 'get_class', 'lcfirst', 'ucfirst', 'iconv', 'empty', 'is_null', 'count', 'print_r', 'var_dump', 'header', 'readfile', 'filesize', 'date', 'time', 'fopen', 'fsockopen', 'feof', 'fread', 'fwrite', 'fclose', 'urlencode', 'urldecode', 'file_get_contents', 'file_put_contents', 'md5', 'uniqid', 'move_uploaded_file', 'strlen', 'substr', 'str_replace', 'str_split', 'str_repeat', 'iconv_strlen', 'iconv_substr', 'iconv_strpos', 'realpath', 'ctype_digit', 'file_exists', 'define', 'is_file', 'is_dir', 'basename', 'fseek', 'filemtime', 'fpassthru', 'defined', 'is_object', 'is_array', 'json_encode', 'json_decode', 'array_merge', 'array_keys', 'in_array', 'array_key_exists', 'array_search', 'stream_context_create', 'ob_start', 'ob_get_clean', 'preg_replace', 'preg_match', 'preg_match_all', 'strtolower', 'strtoupper', 'trim', 'rtrim', 'ltrim', 'nl2br', 'htmlspecialchars', 'ini_get', 'ini_set', 'session_start', 'session_get_cookie_params', 'session_set_cookie_params', 'setcookie', 'pathinfo', 'base64_encode', 'base64_decode', 'sprintf', 'ord', 'chr', 'fgets', 'bindec', 'sleep', 'usleep', 'socket_create', 'socket_bind', 'socket_set_option', 'socket_listen', 'socket_select', 'socket_accept', 'socket_read', 'socket_write', 'socket_shutdown', 'socket_close', 'socket_getpeername', 'socket_last_error', 'socket_strerror', 'is_callable', 'call_user_func', 'error_reporting', 'set_time_limit', 'ob_implicit_flush', 'pack', 'sha1', 'stream_socket_server', 'stream_select', 'stream_socket_accept', 'stream_socket_get_name', 'is_resource', 'is_string', 'parse_url', 'dirname', 'preg_replace_callback', 'preg_quote', 'array_push', 'array_pop', 'unserialize', 'serialize', 'sort', 'intval', 'shell_exec', 'scandir', 'getopt', 'array_diff', 'is_link', 'unlink', 'opendir', 'readdir', 'closedir', 'rmdir', 'fileperms', 'array_map', 'func_num_args', 'func_get_arg', 'strpos', 'rand', 'strncasecmp'
            ),
            'defined' => array(
                '__LINE__', '__FILE__', '__DIR__', '__FUNCTION__', '__CLASS__', '__METHOD__', '__TRAIT__', 'DIRECTORY_SEPARATOR', 'PATH_SEPARATOR', 'PHP_EOL', 'PHP_OS', 'E_ALL', 'STDIN', 'STDOUT'
            ),
            'delimiter' => array(
                '.', ',', ':', ';', '=', '+', '-', '/', '*', '%', '[', ']', '(', ')', '{', '}', '>', '<', '|', '!', '?', '&', '@', '\\', '^', '~'
            ),
        ),
        'phtml' => array(
            'colors' => array(
                'default'   => array('fore' => '#888888'),
            )
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
                'def-call'  => array('fore' => '#0080C0'),
                'self'      => array('fore' => '#00AA00'),
                'digit'     => array('fore' => '#FF00FF'),
                'delimiter' => array('fore' => '#FF0000'),
                'number'    => array('fore' => '#CCCCCC'),
            ),
            'keyword1' => array(
                'def', 'if', 'else', 'elif', 'for', 'in', 'while', 'break', 'continue', 'del', 'try', 'except', 'raise', 'finally', 'from', 'import', 'return', 'pass', 'lambda', 'with', 'as', 'not', 'and', 'or', 'is', 'class'
            ),
            'keyword2' => array(
                'True', 'False', 'None'
            ),
            'function' => array(
                'object', 'dict', 'list', 'tuple', 'set', 'bool', 'float', 'int', 'str', 'slice', 'range', 'len', 'input', 'print', 'min', 'max', 'sum', 'round', 'type', 'open', 'super'
            ),
            'delimiter' => array(
                '.', ',', ':', '=', '+', '-', '/', '*', '%', '[', ']', '(', ')', '{', '}', '>', '<', '|', '!'
            ),
        ),
        'query' => array(
            'colors' => array(
                'default'   => array('fore' => '#0080C0'),
                'comment'   => array('fore' => '#888888'),
                'string'    => array('fore' => '#0000FF'),
                'property'  => array('fore' => '#0080FF'),
                'keyword1'  => array('fore' => '#8000FF'),
                'keyword2'  => array('fore' => '#CC00CC'),
                'function'  => array('fore' => '#808000'),
                'parameter' => array('fore' => '#CC6600'),
                'digit'     => array('fore' => '#FF00FF'),
                'delimiter' => array('fore' => '#FF0000'),
                'number'    => array('fore' => '#CCCCCC'),
            ),
            'keyword1' => array(
                'ВЫБРАТЬ', 'ПЕРВЫЕ', 'РАЗЛИЧНЫЕ', 'РАЗРЕШЕННЫЕ', 'ПОМЕСТИТЬ', 'ИЗ', 'СОЕДИНЕНИЕ', 'ЛЕВОЕ', 'ПРАВОЕ', 'ПО', 'ГДЕ', 'В', 'ИЕРАРХИИ', 'МЕЖДУ', 'ПОДОБНО', 'ЕСТЬ', 'СГРУППИРОВАТЬ', 'ПО', 'УПОРЯДОЧИТЬ', 'ИМЕЮЩИЕ', 'ИТОГИ', 'КАК', 'ВЫБОР', 'КОГДА', 'ИНАЧЕ', 'КОНЕЦ', 'ТОЛЬКО', 'ИЕРАРХИЯ', 'ИЕРАРХИИ', 'ССЫЛКА', 'ОБЪЕДИНИТЬ', 'ВСЕ', 'И', 'ИЛИ', 'НЕ'
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
                'xmldecl'   => array('fore' => '#7777FF'),
                'comment'   => array('fore' => '#888888'),
                'element'   => array('fore' => '#0080C0'),
                'attrname'  => array('fore' => '#808000'),
                'attrvalue' => array('fore' => '#0080FF'),
                'entity'    => array('fore' => '#8000FF'),
                'number'    => array('fore' => '#CCCCCC'),
            ),
        )

    );

    /**
     * Функция для подсветки конфигурации Apache
     */
    public function highlightApache($code) {

        $code = $this->trim($code);

        $pattern = array(
            'comment' => '~^\s*#.*~m',                                   // комментарии
            'vars'    => '~(%|\$)\{[^\}]+\}~',                           // переменные
            'string'  => '~"[^"]*"~',                                    // строки в двойных кавычках
            'section' => '~\<[^>]+\>~',                                  // секция
            'regexp1' => '~(?<=RewriteRule )\S+(?= )~',                  // шаблон рег.выражения в RewriteRule (mod_rewrite)
            'empty'   => '~(?<=RewriteCond )[^\s¤]+(?= )~',              // хак, чтобы след.строка правильно отработала
            'regexp2' => '~(?<=RewriteCond ¤[a-f0-9]{32}¤ )\S+(?=\s)~',  // шаблон рег.выражения в RewriteCond (mod_rewrite)
            'param'   => '~^\s*[a-z]+(?= )~im',                          // параметр
            'flags'   => '~(?<= )\[[^\]]+\](?= |$)~m',                   // флаги (mod_rewrite)
        );

        $code = $this->highlightCodeString($code, $pattern, 'apache');

        return '<pre style="color:'.$this->settings['apache']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    /**
     * Функция для подсветки AWK
     */
    public function highlightAWK($code) {

        $code = $this->trim($code);

        foreach ($this->settings['awk']['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }

        $pattern = array(
            'comment'     => '~# .*~',                    // комментарии
            'spec-var'    => '~\$[0-9]~',                 // позиционные переменные
            '$variable'   => '~\$[_a-z][_a-z0-9]*~',      // позиционные переменные
            '$expression' => '~\$\([^)]+\)~',             // позиционные переменные
            'string'      => '~"[^"]*"~',                 // строки в двойных кавычках
            'keyword'     => '~\b('.implode('|', $this->settings['awk']['keyword']).')\b~',   // ключевые слова
            'begin-end'   => '~\b('.implode('|', $this->settings['awk']['begin-end']).')\b~', // BEGIN и END
            'pattern'     => '~/[^/]+/~', // регулярное выражение
            'digit'       => '~\b\d+\b~', // цифры
            'delimiter'   => '~'.implode('|', $delimiter).'~', // разделители
        );

        $code = $this->highlightCodeString($code, $pattern, 'awk');

        return '<pre style="color:'.$this->settings['awk']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    public function highlightBash($code) {

        $code = $this->trim($code);

        $temp1 = array(
            'comment1'    => '~^ *#+$~m',                          // пустой комментарий
            'comment2'    => '~^ *#+ .*$~m',                       // комментарии от начала строки
            'comment3'    => '~(?<= )#+ .*~',                      // комментарии в конце строки
            'string1'     => "~'[^']*'~",                          // строки в одинарных кавычках
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
            'spec-var'    => '~\$([0-9]|#|!|\*|@|\$|\?)~i',        // специальные переменные
            'variable1'   => '~\$[a-z_][a-z0-9_]*~i',              // переменные
            'variable2'   => '~\$\{[^}]+\}?~i',                    // переменные
            'express'     => '~\$?\(\([^)(]+\)\)~',                // вычисление арифметического выражения
            'execute1'    => '~\$\([^)(]+\)~',                     // подстановка результата выполнения
            'execute2'    => '~\$\([^)(]+\)~',                     // подстановка результата выполнения
            'execute3'    => '~\`[^`]+`~',                         // подстановка результата выполнения
            'string2'     => '~"[^"]*"~',                          // строки в двойных кавычках
            'here-doc'    => '~(?<=\<\<) ?-?([-_A-Za-z]+).*?\1~s', // here doc
            'arr-init'    => '~(?<=[a-z]\=)\([^)]*\)~i',           // инициализация массива
            'keyword'     => '~\b('.implode('|', $this->settings['bash']['keyword']).')\b~i', // ключевые слова
            'command'     => '~\b('.implode('|', $this->settings['bash']['command']).')\b~i', // команды
            'signal'      => '~\b('.implode('|', $this->settings['bash']['signal']).')\b~',   // сигналы
            'bin-bash'    => "~^#!/[-/a-z]+~",                      // что-то типа #!/bin/bash
        );

        $pattern = array_merge($temp1, $temp, $temp2);

        $code = $this->highlightCodeString($code, $pattern, 'bash');

        return '<pre style="color:'.$this->settings['bash']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    /**
     * Функция для подсветки CLI (Windows и Linux)
     */
    public function highlightCLI($code) {

        $code = $this->trim($code);

        foreach ($this->settings['cli']['specchars'] as $value) {
            $specchars[] = '\\'.$value;
        }

        $pattern = array(
            'selected1' => '~\[red\].*\[/red\]~sU',         // выделить текст
            'selected2' => '~\[grn\].*\[/grn\]~sU',         // выделить текст
            'comment'   => '~(?<= )# .*$~m',                // комментарий
            'command'   => '~(?<=^(\$|\>) ).*$~m',          // команда
            'cliprompt' => '~^(\$|\>)(?= |$)~m',            // приглашение
            'specchars' => '~'.implode('|', $specchars).'~' // спец.символы
        );

        $code = $this->highlightCodeString($code, $pattern, 'cli');

        $code = str_replace(array('[red]', '[grn]', '[/red]', '[/grn]'), '', $code);

        return '<pre style="color:'.$this->settings['cli']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    /**
     * Функция не подсвечивает код, но позводяет в коде выделить цветом отдельные фрагменты
     */
    public function highlightCode($code) {

        $code = $this->trim($code);

        foreach ($this->settings['code']['specchars'] as $value) {
            $specchars[] = '\\'.$value;
        }

        $pattern = array(
            'selected1' => '~\[red\].*\[/red\]~sU',         // выделить текст
            'selected2' => '~\[grn\].*\[/grn\]~sU',         // выделить текст
            'selected3' => '~\[border\].*\[/border\]~sU',   // выделить текст
            'specchars' => '~'.implode('|', $specchars).'~' // спец.символы
        );

        $code = $this->highlightCodeString($code, $pattern, 'code');

        $code = str_replace(array('[red]', '[grn]', '[border]', '[/red]', '[/grn]', '[/border]'), '', $code);

        return '<pre style="color:'.$this->settings['code']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    /**
     * Функция для подсветки CSS
     */
    public function highlightCSS($code, $pre = true) {

        if ($pre) {
            $code = $this->trim($code);
        }

        foreach ($this->settings['css']['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }

        $rules = 'import|media|charset|page|font-face';

        $pattern = array(
            'comment'     => '~/\*.*\*/~sU',                      // комментарии
            'css-var'     => '~--[a-z][-a-z0-9]*~',               // CSS-переменные
            'media-value' => '~(?<=@media )[-:)(a-z0-9 ]+(?= {)~',
            'rules'       => '~@('.$rules.')\b~',                 // правила
            'url-cont'    => '~(?<=url\()[^)"\']+~',              // аргумент функции url()
            'string'      => '~"[^"]*"|\'[^\']*\'~',              // строка
            'important'   => '~!important~',                      // !important
            'prop-value'  => '~(?<=:)[^;{]+(?=;)~',               // значение свойства
            'prop-name'   => '~[a-z][-a-z]+\s*(?=:¤)~m',          // CSS-свойство
            'pseudo'      => '~::?[a-z][-.a-z)(+0-9]+~',          // псевдо-элементы и псевдо-классы
            'css-uniq'    => '~#[a-z][-_a-z0-9]+~i',              // селектор, идентификатор
            'css-class'   => '~\.[a-z][-_a-z0-9]+~i',             // селектор, класс
            'delimiter'   => '~'.implode('|', $delimiter).'~',    // разделители
        );

        $code = $this->highlightCodeString($code, $pattern, 'css');
        
        if (!$pre) {
            return $code;
        }

        return '<pre style="color:'.$this->settings['css']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    /**
     * Функция для подсветки языка 1С: Предприятие
     */
    public function highlightERP($code) {

        $code = $this->trim($code);
        $code = $this->collapse($code);

        foreach ($this->settings['erp']['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $pattern = array(
            'comment'   => '~\/\/.*$~m', // комментарии
            'string'    => '~"[^"]*"~',   // строки
            // 'object'    => '~(?<=Новый )[а-яa-z]+\b~ui', // создание объекта
            // 'function'  => '~(?<=Функция )[а-яa-z]+\b~ui', // объявление функции
            // 'procedure' => '~(?<=Процедура )[а-яa-z]+\b~ui', // объявление процедуры
            'keyword1'  => '~\b('.implode('|', $this->settings['erp']['keyword1']).')\b~ui',  // ключевые слова
            'keyword2'  => '~\b('.implode('|', $this->settings['erp']['keyword2']).')\b~ui',  // ключевые слова
            'keyword3'  => '~\b('.implode('|', $this->settings['erp']['keyword3']).')\b~ui',  // ключевые слова
            'def-call'  => '~\b[а-яa-z]+\b\s?(?=\()~ui', // определение или вызов функции или процедуры
            'directive' => '~('.implode('|', $this->settings['erp']['directive']).')~ui', // директивы компиляции
            'area-name' => '~(?<=#Область )[а-яa-z]+~ui', // имя области кода
            'code-area' => '~#(Область|КонецОбласти)~ui', // области кода
            'datetime'  => "~'\d+'~", // дата и время
            'digit'     => '~\b\d+\b~u', // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $code = $this->highlightCodeString($code, $pattern, 'erp');

        $code = str_replace(
            array(chr(5), chr(6)),
            array(
                '<div class="collapse"><i class="fa fa-minus-square-o" aria-hidden="true"></i><div class="collapse-code">',
                '</div><div class="collapse-message">[код свернут]</div></div>'
            ), $code
        );

        return '<pre style="color:'.$this->settings['erp']['colors']['default']['fore'].'" class="erp">' . $code . '</pre>';

    }

    /**
     * Функция для подсветки HTML-кода. Она несколько сложнее остальных, потому что внутри html
     * могут встречаться кусочки js- и css-кода
     */
    public function highlightHTML($code) {

        $code = $this->trim($code);

        /*
         * 1. вырезаем куски javascript-кода, вставляя на это место заглушки, и раскрашиваем все эти куски
         * 2. потом раскрашиваем оставшийся html-код, действуя как обычно
         * 3. вставляем на место заглушек из первого шага раскрашенные кусочки javascript-кода
         */
        $jsSource = $jsReplace = array();
        $pattern = '~<script(?: type="(?:text|application)/javascript")?>(.+)</script>~Us';
        $this->replaceCodeWithStub($code, $jsSource, $jsReplace, $pattern, 'js');

        /*
         * 1. вырезаем куски css-кода, вставляя на это место заглушки, и раскрашиваем все эти куски
         * 2. потом раскрашиваем оставшийся html-код, действуя как обычно
         * 3. вставляем на место заглушек из первого шага раскрашенные кусочки css-кода
         */
        $cssSource = $cssReplace = array();
        $pattern = '~<style(?: type="text/css")?>(.+)</style>~Us';
        $this->replaceCodeWithStub($code, $cssSource, $cssReplace, $pattern, 'css');
 
        // вспомогательная операция перед раскраской атрибутов тегов: вырезаем из html-кода
        // комментарии, иначе будут раскрашены атрибуты тегов закомментированного html-кода
        $cmntSource = $cmntReplace = array();
        $pattern = '~(<\!--.*-->)~sU';
        $this->replaceCodeWithStub($code, $cmntSource, $cmntReplace, $pattern, 'cmnt');
        /*
         * 1. вырезаем атрибуты тегов, вставляя на это место заглушки, и раскрашиваем атрибуты
         * 2. потом раскрашиваем оставшийся html-код, действуя как обычно
         * 3. вставляем на место заглушек из первого шага раскрашенные атрибуты тегов
         */
        $attrSource = $attrReplace = array();
        $pattern = '~<[a-z]+\s+([^>]+)>~';
        $this->replaceCodeWithStub($code, $attrSource, $attrReplace, $pattern, 'attr');
        // вставляем комментарии обратно
        $this->replaceStubWithCode($code, $cmntSource, $cmntReplace);

        /*
         * теперь раскрашиваем html
         */
        $pattern = array(
            'doctype'   => '~<\!DOCTYPE[^>]*>~i',  // <!DOCTYPE html>
            'comment'   => '~<\!--.*-->~sU',       // комментарии
            'entity'    => '~&[a-z]+;~',           // html-сущности
            'element'   => '~</?[a-z]+[^>]*>~',    // открывающие и закрывающие теги
        );
        $code = $this->highlightCodeString($code, $pattern, 'html');

        /*
         * вставляем атрибуты тегов обратно
         */
        $this->replaceStubWithCode($code, $attrSource, $attrReplace);

        /*
         * вставляем куски css-кода обратно
         */
        $this->replaceStubWithCode($code, $cssSource, $cssReplace);

        /*
         * вставляем куски javascript-кода обратно
         */
        $this->replaceStubWithCode($code, $jsSource, $jsReplace);
        
        return '<pre style="color:'.$this->settings['html']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    /**
     * Функция для подсветки JS-кода
     */
    public function highlightJS($code, $pre = true) {

        if ($pre) {
            $code = $this->trim($code);
        }

        foreach ($this->settings['js']['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $pattern = array(
            'comment1'  => '~\/\/ .*$~m',     // комментарии
            'comment2'  => '~/\*.*\*/~sU',    // комментарии
            'string1'   => '~"[^"]*"~',       // строки в двойных кавычках
            'string2'   => "~'[^']*'~",       // строки в одинарных кавычках
            'regexp'    => "~/[^/]+/[igm]*~", // регулярное выражение
            'keyword1'  => '~\b('.implode('|', $this->settings['js']['keyword1']).')\b~i', // ключевые слова
            'keyword2'  => '~\b('.implode('|', $this->settings['js']['keyword2']).')\b~i', // ключевые слова
            //'def-call'  => '~\b[_a-z][_a-z0-9]*\b\s?(?=\()~i', // определение или вызов функции
            'digit'     => '~\b\d+\b~', // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $code = $this->highlightCodeString($code, $pattern, 'js');
        
        if (!$pre) {
            return $code;
        }

        return '<pre style="color:'.$this->settings['js']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    /**
     * Функция для подсветки JSON
     */
    public function highlightJSON($code) {

        $code = $this->trim($code);

        foreach ($this->settings['json']['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $pattern = array(
            'string'    => '~"[^"]*"~',     // строки в двойных кавычках
            'null'      => '~\bnull\b~',
            'bool'      => '~\btrue|false\b~',
            'digit'     => '~\b\d+\b~',    // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $code = $this->highlightCodeString($code, $pattern, 'json');

        return '<pre style="color:'.$this->settings['json']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    /**
     * Функция для подсветки IDLE (Python)
     */
    public function highlightIDLE($code) {

        $code = $this->trim($code);

        foreach ($this->settings['idle']['specchars'] as $value) {
            $specchars[] = '\\'.$value;
        }

        $pattern = array(
            'comment'    => '~(?<= )# .*$~m',                // комментарий
            'command'    => '~(?<=^(\>{3}|\.{3}) ).*$~m',    // команда
            'idleprompt' => '~^(>{3}|\.{3})(?= )~m',         // приглашение
            'specchars'  => '~'.implode('|', $specchars).'~' // спец.символы
        );

        $code = $this->highlightCodeString($code, $pattern, 'idle');

        return '<pre style="color:'.$this->settings['idle']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    /**
     * Функция для подсветки INI
     */
    public function highlightINI($code) {

        $code = $this->trim($code);

        $pattern = array(
            'comment' => '~^;.*~m',              // комментарии
            'string'  => '~"[^"]*"~',            // строки в двойных кавычках
            'section' => '~^\[[_a-z0-9]+\]~mi',  // начало секции
            'param'   => '~^[_a-z.]+(?= =)~im',  // параметр
            'equal'   => '~(?<= )=(?=( |$))~',   // знак =
        );

        $code = $this->highlightCodeString($code, $pattern, 'ini');

        return '<pre style="color:'.$this->settings['ini']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    /**
     * Функция для подсветки LESS
     */
    public function highlightLESS($code) {
        
        $code = $this->trim($code);

        foreach ($this->settings['less']['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }

        $rules = 'import|media|charset|page|font-face';

        $pattern = array(
            'comment1'    => '~\/\/ .*$~m',                       // комментарии
            'comment2'    => '~/\*.*\*/~sU',                      // комментарии
            'css-var'     => '~--[a-z][-a-z0-9]*~',               // CSS-переменные
            'media-value' => '~(?<=@media )[-:)(a-z0-9 ]+(?= {)~',
            'rules'       => '~@('.$rules.')\b~',                 // правила
            'less-var'    => '~@[a-z][-a-z0-9]*~',                // LESS-переменные
            'url-cont'    => '~(?<=url\()[^)"\']+~',              // аргумент функции url()
            'string'      => '~"[^"]*"|\'[^\']*\'~',              // строка
            'important'   => '~!important~',                      // !important
            'prop-value'  => '~(?<=:)[^;{]+(?=;)~',               // значение свойства
            'prop-name'   => '~[a-z][-a-z]+\s*(?=:¤)~m',          // CSS-свойство
            'pseudo'      => '~::?[a-z][-a-z)(+0-9]+~',           // псевдо-элементы и псевдо-классы
            'css-uniq'    => '~#[a-z][-_a-z0-9]+~i',              // селектор, идентификатор
            'css-class'   => '~\.[a-z][-_a-z0-9]+~i',             // селектор, класс
            'delimiter'   => '~'.implode('|', $delimiter).'~',    // разделители
        );

        $code = $this->highlightCodeString($code, $pattern, 'less');

        return '<pre style="color:'.$this->settings['less']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    /**
     * Функция для подсветки MySQL-запросов
     */
    public function highlightMySQL($code) {

        $code = $this->trim($code);

        foreach ($this->settings['mysql']['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $pattern = array(
            'comment1'  => '~(?<= |^)-- .*$~m',  // комментарии
            'comment2'  => '~(?<= |^)# .*$~m',   // комментарии
            'comment3'  => '~/\*.*\*/~sU',       // комментарии
            'string1'   => '~"[^"]*"~',          // строки в двойных кавычках
            'string2'   => "~'[^']*'~",          // строки в одинарных кавычках
            'string3'   => '~`[^`]*`~',          // строки в обратных кавычках
            'type'      => '~\b('.implode('|', $this->settings['mysql']['type']).')\b~i', // типы данных
            'value'     => '~(?<=(OLLATE|HARSET|ENGINE)(\=| ))\b[a-z][_a-z0-9]+\b~i',
            'digit'     => '~\b\d+(\.\d+)?\b~',  // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $code = $this->highlightCodeString($code, $pattern, 'mysql');

        return '<pre style="color:'.$this->settings['mysql']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    /**
     * Функция для подсветки PHP
     */
    public function highlightPHP($code, $pre = true) {

        $code = $this->trim($code);

        foreach ($this->settings['php']['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $super = '\$GLOBALS|\$_SERVER|\$_REQUEST|\$_GET|\$_POST|\$_SISSION|\$_COOKIE|\$_ENV|\$_FILES';
        $pattern = array(
            'comment1'  => '~\/\/ .*$~m',  // комментарии
            'comment2'  => '~/\*.*\*/~sU', // комментарии
            'string1'   => '~"[^"]*"~',    // строки в двойных кавычках
            'string2'   => "~'[^']*'~",    // строки в одинарных кавычках
            'startphp'  => '~<\?php~',     // начало php-кода
            'startecho' => '~<\?=~',       // начало php-кода
            'shortphp'  => '~<\?~',        // начало php-кода
            'stopphp'   => '~\?>~',        // конец php-кода
            'keyword1'  => '~(?<!\$)\b('.implode('|', $this->settings['php']['keyword1']).')\b~i', // ключевые слова
            'keyword2'  => '~(?<!\$)\b('.implode('|', $this->settings['php']['keyword2']).')\b~i', // ключевые слова
            'keyword3'  => '~(?<!\$)\b('.implode('|', $this->settings['php']['keyword3']).')\b~i', // ключевые слова
            'function'  => '~(?<!\->)\b('.implode('|', $this->settings['php']['function']).')\b\s?(?=\()~i', // встроенные функции
            'def-call'  => '~\b[_a-z][_a-z0-9]*\b\s?(?=\()~i', // определение или вызов функции
            'defined'   => '~(?<!(::|t ))\b('.implode('|', $this->settings['php']['defined']).')\b(?! =)~i', // встроенные контстанты
            'constant'  => '~(?<!\$|\\\|>)\b([_A-Z][_A-Z0-9]*)\b(?!\\\)~', // контстанты
            'super-arr' => '~('.$super.')\b~', // супер-массивы
            'digit'     => '~\b\d+(\.\d+)?\b~', // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $code = $this->highlightCodeString($code, $pattern, 'php');
        
        if (!$pre) {
            return $code;
        }

        return '<pre style="color:'.$this->settings['php']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    /**
     * Функция для подсветки PHP + HTML
     */
    public function highlightPHTML($code) {

        $code = $this->trim($code);

        /*
         * Сначала врезаем кусочки php-кода, вставляем на это место заглушки, раскрашиваем все эти кусочки.
         * Потом раскрашиваем оставшийся чистый HTML и вставляем обратно вырезанные ренее кусочки PHP-кода
         * на место заглушек.
         */
         
        // TODO: код ниже можно заменить на вызов replaceCodeWithStub()

        /*
         * ищем кусочки php-кода, вырезаем, вставляем на эти места заглушки
         */
        $offset = 0;
        $source = array(); // массив кусочков php-кода
        $replace = array(); // массив заглушек
        while (preg_match('~<\?(=|php)?.*\?>~Us', $code, $match, PREG_OFFSET_CAPTURE, $offset)) {
            $item = $match[0][0]; // очередной кусочек php-кода
            $offset = $match[0][1];
            $length = strlen($match[0][0]);

            $piece = $this->highlightPHP($item, false); // раскрашиваем кусочек php-кода
            $source[] = '<span style="color:'.$this->settings['php']['colors']['default']['fore'].'">' . $piece . '</span>';
            $rand = '¤'.md5(uniqid(mt_rand(), true)).'¤'; // заглушка
            $replace[] = $rand;
            // вырезаем кусочек php-кода и вставляем на это место заглушку
            $code = substr_replace($code, $rand, $offset, $length);
            $offset = $offset + strlen($rand);
        }

        /*
         * раскрашиваем чистый html
         */
        $code = $this->highlightHTML($code);

        /*
         * вставляем кусочки php-кода на место заглушек
         */
        $source = array_reverse($source);
        $replace = array_reverse($replace);
        if (!empty($source)) {
            $code = str_replace($replace, $source, $code);
        }

        return $code;

    }

    /**
     * Функция для подсветки Python
     */
    public function highlightPython($code) {

        $code = $this->trim($code);

        foreach ($this->settings['python']['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $pattern = array(
            'comment'   => '~# .*$~m',             // комментарии
            'string3'   => '~""".*?"""~s',         // строки в тройных кавычках
            'string4'   => "~'''.*?'''~s",         // строки в тройных кавычках
            'string1'   => '~[ru]{0,2}"[^"]*"~',   // строки в двойных кавычках
            'string2'   => "~[ru]{0,2}'[^']*'~",   // строки в одинарных кавычках
            'keyword1'  => '~\b('.implode('|', $this->settings['python']['keyword1']).')\b~', // ключевые слова
            'keyword2'  => '~\b('.implode('|', $this->settings['python']['keyword2']).')\b~', // ключевые слова
            'self'      => '~\bself\b~', // self
            'function'  => '~(?<!\.)\b('.implode('|', $this->settings['python']['function']).')(?=\()~i', // встроенные функции
            'def-call'  => '~\b[_a-z][_a-z0-9]*\b\s?(?=\()~i', // определение или вызов функции
            'digit'     => '~\b\d+\b~',            // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $code = $this->highlightCodeString($code, $pattern, 'python');

        return '<pre style="color:'.$this->settings['python']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    /**
     * Функция для подсветки языка запросов 1С:Предприятие
     */
    public function highlightQuery($code) {

        $code = $this->trim($code);

        foreach ($this->settings['query']['delimiter'] as $value) {
            $delimiter[] = '\\'.$value;
        }
        $pattern = array(
            'string'    => '~"[^"]*"~',  // строки
            'comment'   => '~\/\/.*$~m', // комментарии
            'property'  => '~(?<=\{)[^}{]*(?=\})~',   // характеристики
            'keyword1'  => '~\b('.implode('|', $this->settings['query']['keyword1']).')\b(?= |,|$)~mu', // ключевые слова
            'keyword2'  => '~\b('.implode('|', $this->settings['query']['keyword2']).')\b(?= |$)~mui',  // ключевые слова
            'function'  => '~\b('.implode('|', $this->settings['query']['function']).')(?=\()~ui', // функции
            'parameter' => '~&[а-яё]+\b~ui', // параметр
            'digit'     => '~\b\d+\b~', // цифры
            'delimiter' => '~'.implode('|', $delimiter).'~', // разделители
        );

        $code = $this->highlightCodeString($code, $pattern, 'query');

        return '<pre style="color:'.$this->settings['query']['colors']['default']['fore'].'">' . $code . '</pre>';

    }

    /**
     * Функция для подсветки XML
     */
    public function highlightXML($code) {

        $code = $this->trim($code);

        $pattern = array(
            'xmldecl'   => '~<\?xml[^>]*>~',                       // <?xml version="1.0" encoding="utf-8"...>
            'comment'   => '~<\!--.*-->~sU',                       // комментарии
            'attrname'  => '~(?<= )[-a-zA-Zа-яА-Я0-9:]+(?=\=")~u', // имя атрибут тега
            'attrvalue' => '~(?<=\=)"[^"]*"(?=(\s|/|>))~',         // значение атрибут тега
            'element'   => '~</?[a-zA-Zа-яА-Я0-9]+[^>]*>~u',       // открывающие и закрывающие теги
            'entity'    => '~&[a-z]+;~',                           // html-сущности
        );

        $code = $this->highlightCodeString($code, $pattern, 'xml');

        return '<pre style="color:'.$this->settings['xml']['colors']['default']['fore'].'">' . $code . '</pre>';
    }

    /**
     * Основная функция для подсветки кода
     */
    private function highlightCodeString($code, $pattern, $lang) {

        // заменяем экранированный обратный слэш на экзотические символы,, чтобы правильно раскрашивать код
        $code = str_replace('\\\\', '♠♠', $code);
        // заменяем экранированные кавычки на экзотические символы, чтобы правильно раскрашивать код
        $code = str_replace("\\'", '♣♣', $code);
        $code = str_replace('\\"', '♥♥', $code);
        // заменяем экранированный прямой слэш на экзотические символы, чтобы правильно раскрашивать код
        $code = str_replace("\\/", '♦♦', $code);
        // заменяем одинарные кавычки внутри двойных и двойные внутри одинарных, чтобы правильно раскрашивать код
        $code = $this->replaceQuoteWithStub($code);

        $source = array();
        $replace = array();
        foreach ($pattern as $color => $regexp) {

            $offset = 0;
            while (preg_match($regexp, $code, $match, PREG_OFFSET_CAPTURE, $offset)) {

                $item = $match[0][0];
                $offset = $match[0][1];
                $length = strlen($match[0][0]);
                $piece = str_replace(array('&', '>', '<'), array('&amp;', '&gt;', '&lt;'), $match[0][0]);

                $styles = array();
                if (isset($this->settings[$lang]['colors'][$color]['fore'])) {
                    $styles[] = 'color:'.$this->settings[$lang]['colors'][$color]['fore'];
                }
                if (isset($this->settings[$lang]['colors'][$color]['back'])) {
                    $styles[] = 'background:'.$this->settings[$lang]['colors'][$color]['back'];
                }
                if (isset($this->settings[$lang]['colors'][$color]['border'])) {
                    $styles[] = 'border:1px solid '.$this->settings[$lang]['colors'][$color]['border'];
                }
                $style = '';
                if (!empty($styles)) {
                    $style = implode(';', $styles);
                }
                if (!empty($style)) {
                    $source[] = '<span style="' . $style . '">' . $piece . '</span>';
                } else {
                    $source[] = $piece;
                }
                $rand = '¤'.md5(uniqid(mt_rand(), true)).'¤';
                $replace[] = $rand;
                $code = substr_replace($code, $rand, $offset, $length);
                $offset = $offset + strlen($rand);

            }

        }

        $source = array_reverse($source);
        $replace = array_reverse($replace);

        if (!empty($source)) {
            $code = str_replace($replace, $source, $code);
        }

        // заменяем экзотические символы обратно на экранированный обратный слэш
        $code = str_replace('♠♠', '\\\\', $code);
        // заменяем экзотические символы обратно на экранированные кавычки
        $code = str_replace('♣♣', "\\'", $code);
        $code = str_replace('♥♥', '\\"', $code);
        // заменяем экзотические символы обратно на экранированный прямой слэш
        $code = str_replace('♦♦', "\\/", $code);
        // замена экзотических символов обратно на кавычки, см. метод replaceQuoteInString()
        $code = $this->replaceStubWithQuote($code);
        
        return $code;

    }

    /**
     * Вспомогательная фунция, которая удаляет лишние пробелы
     */
    private function trim($code) {
        $code = str_replace("\r\n", "\n", $code);
        $code = str_replace("\t", '    ', $code);
        $code = trim($code, "\n");
        return $code;
    }

    /**
     * Заменяет двойную/одинарную кавычку на заглушку внутри строки в одинарных/двойных кавычках
     */
    private function replaceQuoteWithStub($code) {
        // TODO: кавычка в комментарии ломает работу подсветки кода
        /*
         * Находим в строке кода первую кавычку (одинарную или двойную), потом от этого места
         * находим вторую кавычку, потом от этого места находим третью и так далее. Задача в
         * том, чтобы определить, когда одинарная кавычка находится внутри строки в двойных
         * кавычках. И когда двойная кавычка находится внутри строки в одинарных кавычках.
         * Кавычки внутри строки заменяем на экзотические символы, чтобы правильно раскрасить
         * код. А когда раскраска сделана, экзотические символы заменяются обратно на кавычки.
         */
        $offset = 0; // сдвиг от начала строки кода, который надо раскрасить
        $singleQuoteString = false; // признак того, что мы внутри строки в одинарных кавычках
        $doubleQuoteString = false; // признак того, что мы внутри строки в двойных кавычках
        while (preg_match('~[\'"]~', $code, $match, PREG_OFFSET_CAPTURE, $offset)) {
            $position = $match[0][1]; // позиция вождения очередной одинарной или двойной кавычки
            $quote = $match[0][0]; // собственно, сам символ кавычки (двойной или одинарной)
            /*
             * Возможны три варианта:
             * 1. Мы внутри строки в одинарных кавычках
             * 2. Мы внутри строки в двойных кавычках
             * 3. Ни первое, ни второе
             */
            if (false === $singleQuoteString && false === $doubleQuoteString) { // третий случай
                if ($quote === '"') { // ситуация изменилась, теперь это второй случай
                    $doubleQuoteString = true;
                }
                if ($quote === "'") { // ситуация изменилась, теперь это первый случай
                    $singleQuoteString = true;
                }
            } elseif ($doubleQuoteString) { // второй случай, мы внутри строки в двойных кавычках
                // если мы встретили двойную кавычку, это означает, что строка "..." здесь заканчивается
                if ($quote === '"') {
                    $doubleQuoteString = false;
                }
                // если мы встретили одинарную кавычку, заменяем ее, чтобы не было коллизий при подсветке
                if ($quote === "'") {
                    $code = substr_replace($code, '☺', $position, 1);
                }
            } elseif ($singleQuoteString) { // третий случай, мы внутри строки в одинарных кавычках
                // если мы встретили одинарную кавычку, это означает, что строка '...' здесь заканчивается
                if ($quote === "'") {
                    $singleQuoteString = false;
                }
                // если мы встретили двойную кавычку, заменяем ее, чтобы не было коллизий при подсветке
                if ($quote === '"') {
                    $code = substr_replace($code, '☻', $position, 1);
                }
            }
            $offset = $position + 1; // следующий поиск кавычки уже с этой позиции
        }
        
        return $code;
    }

    /**
     * Заменяет заглушку на двойную/одинарную кавычку внутри строки в одинарных/двойных кавычках,
     * см. функцию replaceQuoteWithStub() выше
     */
    private function replaceStubWithQuote($code) {
        $code = str_replace('☺', "'", $code);
        $code = str_replace('☻', '"', $code);
        return $code;
    }
    
    /**
     * Вспомогательная функция, вырезает из html-кода кусочки js- и css-кода и заменяет их на заглушки.
     * $string это исходный код, который раскрашиваем
     * $source это массив кусочков кода, которые вырезаем
     * $replace это массив заглушек, которые вставляются на место вырезанных кусочков кода
     * $pattern это шаблон, по которому вырезаются кусочки кода
     * $type это тип кода, который вырезаем: js, css, attr, cmnt
     */
    private function replaceCodeWithStub(&$string, &$source, &$replace, $pattern, $type) {
        $offset = 0; // смещение относительно начала строки кода, с которого начинается поиск очередного кусочка ja или css
        $source = array();
        $replace = array();
        while (preg_match($pattern, $string, $match, PREG_OFFSET_CAPTURE, $offset)) {
            $item = $match[1][0]; // это кусочек кода внутри <stript>...</script>

            $offset = $match[0][1];
            $startReplace = $match[1][1];
            
            $codeLength = strlen($match[1][0]); // длина кусочка кода внутри <stript>...</script>
            $totalLength = strlen($match[0][0]); // длина кусочка кода внутри <stript>...</script> + длина <stript> + длина </script>
            $tagLength = $totalLength - $codeLength; // длина <stript> + длина </script>

            if ($type == 'js') {
                $piece = $this->highlightJS($item, false);
                $source[] = '<span style="color:'.$this->settings[$type]['colors']['default']['fore'].'">' . $piece . '</span>';
            }
            if ($type == 'css') {
                $piece = $this->highlightCSS($item, false);
                $source[] = '<span style="color:'.$this->settings[$type]['colors']['default']['fore'].'">' . $piece . '</span>';
            }
            if ($type == 'attr') {
                $source[] = $this->highlightAttribute($item);
            }
            if ($type == 'cmnt') {
                $source[] = $item;
            }

            $rand = '¤'.md5(uniqid(mt_rand(), true)).'¤';
            $replace[] = $rand;
            $string = substr_replace($string, $rand, $startReplace, $codeLength);
            $offset = $offset + strlen($rand) + $tagLength;
        }
    }

    /**
     * Вспомогательная функция, заменяет заглушки на раскрашенный код. См. функцию
     * replaceCodeWithStub() выше
     */
    private function replaceStubWithCode(&$string, $source, $replace) {
        $source = array_reverse($source);
        $replace = array_reverse($replace);
        if (!empty($source)) {
            $string = str_replace($replace, $source, $string);
        }
    }
    
    /**
     * Вспомогательная функция, которая раскрашивает атрибуты тегов в html-коде
     */
    private function highlightAttribute($code) {
        $code = ' '.$code;
        $pattern = array(
            'attrval1' => '~"[^"]*"~',                       // значение атрибута тега
            'attrval2' => "~'[^']*'~",                       // значение атрибута тега
            'attrname' => '~(?<= )[-a-z0-9:]+(?=(\=|\s))~',  // имя атрибута тега
        );
        return substr($this->highlightCodeString($code, $pattern, 'html'), 1);
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
    
    private function collapse($code) {
        $strings = explode("\n", $code);

        foreach ($strings as $string) {
            if (iconv_substr($string, 0, 10) === 'Процедура '
                || iconv_substr($string, 0, 8) === 'Функция '
                || iconv_substr($string, 0, 9) === '#Область '
                || iconv_substr($string, 0, 13) === '    #Область ') {
                $result[] = $string . chr(5);
            } elseif (iconv_substr($string, 0, 14) === 'КонецПроцедуры'
                      || iconv_substr($string, 0, 12) === 'КонецФункции'
                      || iconv_substr($string, 0, 13) === '#КонецОбласти'
                      || iconv_substr($string, 0, 17) === '    #КонецОбласти') {
                $result[] = chr(6) . $string . "\n";
            } else {
                $result[] = $string . "\n";
            }
        }
        return implode('', $result);
    }
    
    private function codeBlocks($code) {
        $lines = explode("\n", $code);
        $pattrenStart1 = '~^ {4}(foreach|for|while|if|) \(~';
        $pattrenStart2 = '~^ {4}\} else~';
        $patternStop1 = '~^ {4}\}~';
        
        // первый уровень
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
    }

}