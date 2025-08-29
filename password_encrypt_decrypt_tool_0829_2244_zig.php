<?php
// 代码生成时间: 2025-08-29 22:44:05
class PasswordTool {
    /**
     * Encrypts a password using PHP's password_hash function.
     *
     * @param string $password The password to encrypt.
     * @return string The encrypted password hash.
     * @throws Exception If the encryption fails.
     */
    public function encryptPassword($password) {
        try {
            // Use password_hash to encrypt the password
            $hash = password_hash($password, PASSWORD_DEFAULT);
            if ($hash === false) {
                throw new Exception('Encryption failed. Please try again later.');
            }
            return $hash;
        } catch (Exception $e) {
            // Handle any exceptions during encryption
            error_log($e->getMessage());
            throw $e;
        }
    }

    /**
     * Decrypts a password hash to verify if it matches the given password.
     *
     * @param string $password The password to verify against the hash.
     * @param string $hash The password hash to verify.
     * @return bool True if the password matches the hash, false otherwise.
     */
    public function decryptPassword($password, $hash) {
        // Use password_verify to check if the password matches the hash
        return password_verify($password, $hash);
    }
}

// Usage example
$passwordTool = new PasswordTool();
$originalPassword = 'my_secret_password';

// Encrypt the password
$encryptedPassword = $passwordTool->encryptPassword($originalPassword);
echo "Encrypted password: " . $encryptedPassword . "
";

// Decrypt the password to verify
$isMatch = $passwordTool->decryptPassword($originalPassword, $encryptedPassword);
echo "Password matches: " . ($isMatch ? 'Yes' : 'No') . "
";