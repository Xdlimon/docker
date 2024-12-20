<?php
// app/Models/ServerModel.php

namespace App\Models;

class ServerModel
{
    // Метод для выполнения команды shell
    public function executeCommand($cmd)
    {
        // Безопасность: проверяем команду, чтобы предотвратить небезопасные команды
        $allowedCommands = ['ls', 'df', 'top', 'ps']; // Можешь расширить список разрешенных команд

        // Разделяем команду по пробелам, чтобы избежать выполнения небезопасных команд
        $cmdParts = explode(' ', $cmd);
        $baseCommand = $cmdParts[0];

        if (in_array($baseCommand, $allowedCommands)) {
            // Если команда разрешена, выполняем
            return shell_exec($cmd);
        } else {
            // Если команда не разрешена, возвращаем ошибку
            return "Команда не разрешена!";
        }
    }
}
