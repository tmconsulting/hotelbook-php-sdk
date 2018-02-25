<?php

namespace Hotelbook\Method\Former;

class AddOrderMessage extends BaseFormer
{
    public function form($response)
    {
        $message = object_get($response, 'Message');

        return [
          'id' => (int)  object_get($message, 'Id'),
          'type' => (string)  object_get($message, 'Type'),
          'message' => (string)  object_get($message, 'Message'),
          'direction' => (string)  object_get($message, 'Direction'),
          'isRead' => (boolean)  object_get($message, 'isRead'),
          'date' => (string)  object_get($message, 'Date'),
          'userName' => (string) object_get($message, 'User.Name'),
        ];
    }
}