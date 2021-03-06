<?php

namespace Nuwave\Lighthouse\Schema\Types;

use Illuminate\Http\Request;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Subscriptions\Subscriber;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

abstract class GraphQLSubscription
{
    /**
     * Check if subscriber can listen to this subscription.
     *
     * @param  \Nuwave\Lighthouse\Subscriptions\Subscriber  $subscriber
     * @return bool
     */
    public function can(Subscriber $subscriber)
    {
        return true;
    }

    /**
     * Encode topic name.
     *
     * @param  \Nuwave\Lighthouse\Subscriptions\Subscriber  $subscriber
     * @param  string  $fieldName
     * @return string
     */
    public function encodeTopic(Subscriber $subscriber, string $fieldName)
    {
        return strtoupper(snake_case($fieldName));
    }

    /**
     * Decode topic name.
     *
     * @param  string  $fieldName
     * @param  mixed  $root
     * @return string
     */
    public function decodeTopic(string $fieldName, $root)
    {
        return strtoupper(snake_case($fieldName));
    }

    /**
     * Resolve the subscription.
     *
     * @param  mixed $root
     * @param  mixed[] $args
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext $context
     * @param  \GraphQL\Type\Definition\ResolveInfo  $info
     * @return mixed
     */
    public function resolve($root, array $args, GraphQLContext $context, ResolveInfo $info)
    {
        return $root;
    }

    /**
     * Check if subscriber is allowed to listen to the subscription.
     *
     * @param  \Nuwave\Lighthouse\Subscriptions\Subscriber  $subscriber
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    abstract public function authorize(Subscriber $subscriber, Request $request);

    /**
     * Filter subscribers who should receive subscription.
     *
     * @param  \Nuwave\Lighthouse\Subscriptions\Subscriber  $subscriber
     * @param  mixed  $root
     * @return bool
     */
    abstract public function filter(Subscriber $subscriber, $root);
}
