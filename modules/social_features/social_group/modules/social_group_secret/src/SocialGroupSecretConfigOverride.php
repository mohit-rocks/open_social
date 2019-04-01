<?php

namespace Drupal\social_group_secret;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Config\ConfigFactoryOverrideInterface;
use Drupal\Core\Config\StorageInterface;

/**
 * Class SocialGroupSecretConfigOverride.
 *
 * @package Drupal\social_group_secret
 */
class SocialGroupSecretConfigOverride implements ConfigFactoryOverrideInterface {

  /**
   * Load overrides.
   */
  public function loadOverrides($names) {
    $overrides = [];

    $config_names = [
      'search_api.index.social_all',
      'search_api.index.social_groups',
    ];

    foreach ($config_names as $config_name) {
      if (in_array($config_name, $names)) {
        $overrides[$config_name] = [
          'field_settings' => [
            'rendered_item' => [
              'configuration' => [
                'view_mode' => [
                  'entity:group' => [
                    'secret_group' => 'teaser',
                  ],
                ],
              ],
            ],
          ],
        ];
      }
    }

    $config_names = [
      'views.view.search_all',
      'views.view.search_groups',
    ];

    foreach ($config_names as $config_name) {
      if (in_array($config_name, $names)) {
        $overrides[$config_name] = [
          'display' => [
            'default' => [
              'display_options' => [
                'row' => [
                  'options' => [
                    'view_modes' => [
                      'entity:group' => [
                        'secret_group' => 'teaser',
                      ],
                    ],
                  ],
                ],
              ],
            ],
          ],
        ];
      }
    }

    return $overrides;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheSuffix() {
    return 'SocialGroupSecretConfigOverride';
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheableMetadata($name) {
    return new CacheableMetadata();
  }

  /**
   * {@inheritdoc}
   */
  public function createConfigObject($name, $collection = StorageInterface::DEFAULT_COLLECTION) {
    return NULL;
  }

}
