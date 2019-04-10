<?php

namespace Drupal\taller_chat_user\Plugin\GraphQL\Mutations;

use Drupal\Core\DependencyInjection\DependencySerializationTrait;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\user\UserInterface;
use Drupal\graphql\Plugin\GraphQL\Mutations\MutationPluginBase;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

use Youshido\GraphQL\Execution\ResolveInfo;

/**
 * Logout User.
 *
 * @GraphQLMutation(
 *   id = "user_logou",
 *   name = "userLogout",
 *   type = "User",
 *   secure = false,
 *   nullable = false,
 *   schema_cache_tags = {"user_login"}
 * )
 */
class UserLogout extends MutationPluginBase implements ContainerFactoryPluginInterface {
  use DependencySerializationTrait;
  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function __construct(
    array $configuration,
    $pluginId,
    $pluginDefinition
  ) {
    parent::__construct($configuration, $pluginId, $pluginDefinition);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $pluginId, $pluginDefinition) {
    return new static(
      $configuration,
      $pluginId,
      $pluginDefinition,
      $container->get('entity_type.manager'),
      $container->get('current_user')
    );
  }

  /**
   * Mutation resolver.
   */
  public function resolve($value, array $args, ResolveInfo $info) {
    $this->logout();
  }

  /**
   * Logout user.
   */
  public function logout() {
    user_logout();
  }

}
