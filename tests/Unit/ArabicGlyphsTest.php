<?php

namespace Tests\Unit;

use App\Support\ArabicGlyphs;
use PHPUnit\Framework\TestCase;

class ArabicGlyphsTest extends TestCase
{
    public function test_it_shapes_and_reorders_arabic_text(): void
    {
        $this->assertSame('ﺔﺒﺨﻨﻟﺍ', ArabicGlyphs::shape('النخبة'));
    }

    public function test_it_preserves_ltr_sequences_after_reordering(): void
    {
        $this->assertSame('2024 ﺔﻣﺪﺨﻟﺍ', ArabicGlyphs::shape('الخدمة 2024'));
    }
}
