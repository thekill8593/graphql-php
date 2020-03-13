<?php

use App\Models\Address;
use App\Models\User;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

$userType = new ObjectType([
    'name' => 'User',
    'description' => 'Este es el tipo de dato Usuario',
    'fields' => function() use(&$addressType) {
        return [
            'id' => Type::int(),
            'first_name' => Type::string(),
            'last_name' => Type::string(),
            'email' => Type::string(),
            'addresses' => [
                "type" => Type::listOf($addressType),
                "resolve" => function ($root, $args) {
                    $userId = $root['id'];
                    $user = User::where('id', $userId)->with(['addresses'])->first();
                    return $user->addresses->toArray();
                }
            ]
        ];
    }    
]);

$addressType = new ObjectType([
    'name' => 'Address',
    'description' => 'Este es el tipo de dato Direccion',
    'fields' => [
        'id' => Type::int(),
        'user_id' => Type::int(),
        'name' => Type::string(),
        'description' => Type::string(),
        'user' => [
            "type" => $userType,
            "resolve" => function ($root, $args) {
                $addressId = $root['id'];
                $address = Address::where('id', $addressId)->with(['user'])->first();
                return $address->user->toArray();
            }
        ]       
    ]
]);