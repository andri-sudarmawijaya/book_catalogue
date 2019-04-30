<?php

/**
 * @file
 * Contains book.page.inc.
 *
 * Page callback for Book entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Book templates.
 *
 * Default template: book.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_book(array &$variables) {
  // Fetch Book Entity Object.
  $book = $variables['elements']['#book'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
