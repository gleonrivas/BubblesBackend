<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerNDV3HzZ\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerNDV3HzZ/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerNDV3HzZ.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerNDV3HzZ\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerNDV3HzZ\App_KernelDevDebugContainer([
    'container.build_hash' => 'NDV3HzZ',
    'container.build_id' => '06973d31',
    'container.build_time' => 1675883335,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerNDV3HzZ');
