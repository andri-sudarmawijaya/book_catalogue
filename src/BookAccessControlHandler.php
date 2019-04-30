<?php

namespace Drupal\book_catalogue;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Book entity.
 *
 * @see \Drupal\book_catalogue\Entity\Book.
 */
class BookAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\book_catalogue\Entity\BookInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished book entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published book entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit book entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete book entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add book entities');
  }

}
