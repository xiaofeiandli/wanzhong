<?php

namespace common\base;


class Encrypt
{
    protected $_config = array(
        'hash'      => 'sha1',
        'xor'       => false,
        'mcrypt'    => false,
        'noise'     => true,
        'cipher'    => 'des-ecb'
    );

    protected $_key;

    /**
     * Constructor
     *
     * @param string $key
     * @param array $config
     */
    public function __construct($key = null, $config = array())
    {
        $this->_key = $key;

        if (function_exists('mcrypt_encrypt')) {
            $this->_config['mcrypt'] = true;
        }

        $this->_config = $config + $this->_config;
    }

    /**
     * Set or get config
     *
     * @param mixed $key
     * @param mixed $value
     * @return mixed
     */
    public function config($key = null, $value = null)
    {
        if (is_null($key)) {
            return $this->_config;
        }

        if (is_array($key)) {
            $this->_config = $key + $this->_config;
            return $this;
        }

        if (is_null($value)) {
            return $this->_config[$key];
        }

        $this->_config[$key] = $value;
    }

    /**
     * Encode
     *
     * @param string $str
     * @param string $key
     * @return string
     */
    public function encode($str, $key = null)
    {
        if (is_null($key)) {
            $key = $this->_key;
        }

        if ($this->_config['xor']) {
            $str = $this->_xorEncode($str, $key);
        }

        if ($this->_config['mcrypt']) {
            $str = $this->_mcryptEncode($str, $key);
        }

        if ($this->_config['noise']) {
            $str = $this->_noise($str, $key);
        }

        $data =  base64_encode($str);
        $data = str_replace(array('+','/'),array('-','_'),$data);
        return $data;
    }

    /**
     * Decode
     *
     * @param string $str
     * @param string $key
     * @return string
     */
    public function decode($str, $key = null)
    {
        if (is_null($key)) $key = $this->_key;

        //if (preg_match('/[^a-zA-Z0-9\/\+=]/', $str)) {
        if (preg_match('/[^a-zA-Z0-9\-\+=_]/', $str)) {
            return false;
        }

        $str = str_replace(array('-','_'),array('+','/'),$str);
        $str = base64_decode($str);

        if ($this->_config['noise']) {
            $str = $this->_denoise($str, $key);
        }

        if ($this->_config['mcrypt']) {
            $str = $this->_mcryptDecode($str, $key);
        }

        if ($this->_config['xor']) {
            $str = $this->_xorDecode($str, $key);
        }

        return $str;
    }

    /**
     * openssl encode
     *
     * @param string $str
     * @param string $key
     * @return string
     */
    protected function _mcryptEncode($str, $key)
    {
        $cipher = $this->_config['cipher'];
        return openssl_encrypt($str, $cipher, $key);
    }

    /**
     * openssl decode
     *
     * @param string $str
     * @param string $key
     * @return string
     */
    protected function _mcryptDecode($str, $key)
    {
        $cipher = $this->_config['cipher'];

        return rtrim(openssl_decrypt($str, $cipher, $key));
    }

    /**
     * XOR encode
     *
     * @param string $str
     * @param string $key
     * @return string
     */
    protected function _xorEncode($str, $key)
    {
        $rand = $this->_config['hash'](rand());
        $code = '';
        for ($i = 0; $i < strlen($str); $i++) {
            $r = substr($rand, ($i % strlen($rand)), 1);
            $code .= $r . ($r ^ substr($str, $i, 1));
        }

        return $this->_xor($code, $key);
    }

    /**
     * XOR decode
     *
     * @param string $str
     * @param string $key
     * @return string
     */
    protected function _xorDecode($str, $key)
    {
        $str = $this->_xor($str, $key);
        $code = '';
        for ($i = 0; $i < strlen($str); $i++) {
            $code .= (substr($str, $i++, 1) ^ substr($str, $i, 1));
        }
        return $code;
    }

    /**
     * XOR
     *
     * @param string $str
     * @param string $key
     * @return string
     */
    protected function _xor($str, $key)
    {
        $hash = $this->_config['hash']($key);
        $code = '';
        for ($i = 0; $i < strlen($str); $i++) {
            $code .= substr($str, $i, 1) ^ substr($hash, ($i % strlen($hash)), 1);
        }
        return $code;
    }

    /**
     * Noise
     *
     * @see http://www.ciphersbyritter.com/GLOSSARY.HTM#IV
     * @param string $str
     * @param string $key
     * @return string
     */
    protected function _noise($str, $key)
    {
        $hash = $this->_config['hash']($key);
        $hashlen = strlen($hash);
        $strlen = strlen($str);
        $code = '';

        for ($i = 0, $j = 0; $i < $strlen; ++$i, ++$j) {
            if ($j >= $hashlen) $j = 0;
            $code .= chr((ord($str[$i]) + ord($hash[$j])) % 256);
        }

        return $code;
    }

    /**
     * Denoise
     *
     * @param string $str
     * @param string $key
     * @return string
     */
    protected function _denoise($str, $key)
    {
        $hash = $this->_config['hash']($key);
        $hashlen = strlen($hash);
        $strlen = strlen($str);
        $code = '';

        for ($i = 0, $j = 0; $i < $strlen; ++$i, ++$j) {
            if ($j >= $hashlen) $j = 0;
            $temp = ord($str[$i]) - ord($hash[$j]);
            if ($temp < 0) $temp = $temp + 256;
            $code .= chr($temp);
        }

        return $code;
    }
}