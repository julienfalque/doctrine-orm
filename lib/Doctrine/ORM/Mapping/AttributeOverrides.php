<?php

declare(strict_types=1);

namespace Doctrine\ORM\Mapping;

use Attribute;

use function is_array;

/**
 * This annotation is used to override the mapping of a entity property.
 *
 * @Annotation
 * @NamedArgumentConstructor()
 * @Target("CLASS")
 */
#[Attribute(Attribute::TARGET_CLASS)]
final class AttributeOverrides implements Annotation
{
    /**
     * One or more field or property mapping overrides.
     *
     * @var array<\Doctrine\ORM\Mapping\AttributeOverride>
     */
    public $overrides = [];

    /**
     * @param array<mixed>|AttributeOverride $overrides
     */
    public function __construct($overrides)
    {
        if (! is_array($overrides)) {
            $overrides = [$overrides];
        }

        foreach ($overrides as $override) {
            if (! ($override instanceof AttributeOverride)) {
                throw MappingException::invalidOverrideType('AttributeOverride', $override);
            }

            $this->overrides[] = $override;
        }
    }
}
