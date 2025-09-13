<?php
// 代码生成时间: 2025-09-13 19:56:22
use Zend\Crypt\BlockCipher;
use Zend\Math\Rand;

class PasswordEncryptionDecryptionTool
{
    /**
     * @var string The encryption key
     */
    protected $key;

    public function __construct($key)
    {
        // Ensure the key is a valid string
        if (!is_string($key)) {
            throw new InvalidArgumentException('Encryption key must be a string.');
        }

        $this->key = $key;
    }

    /**
     * Encrypts a password
     *
     * @param string $password The password to encrypt
     * @return string The encrypted password
     */
    public function encryptPassword($password)
    {
        $cipher = BlockCipher::factory('aes', array(
            'key' => $this->key,
        ));

        // Encrypt the password
        $encryptedPassword = $cipher->encrypt($password);

        return $encryptedPassword;
    }

    /**
     * Decrypts a password
     *
     * @param string $encryptedPassword The encrypted password to decrypt
     * @return string The decrypted password
     */
    public function decryptPassword($encryptedPassword)
    {
        $cipher = BlockCipher::factory('aes', array(
            'key' => $this->key,
        ));

        // Decrypt the password
        $decryptedPassword = $cipher->decrypt($encryptedPassword);

        return $decryptedPassword;
    }
}

// Usage example
try {
    $encryptionKey = 'your_encryption_key_here';
    $passwordTool = new PasswordEncryptionDecryptionTool($encryptionKey);

    $originalPassword = 'your_password_here';

    // Encrypt the password
    $encryptedPassword = $passwordTool->encryptPassword($originalPassword);
    echo 'Encrypted Password: ' . $encryptedPassword . "\
";

    // Decrypt the password
    $decryptedPassword = $passwordTool->decryptPassword($encryptedPassword);
    echo 'Decrypted Password: ' . $decryptedPassword . "\
";

} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . "\
";
}
