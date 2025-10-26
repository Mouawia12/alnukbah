<?php

namespace App\Support;

class ArabicGlyphs
{
    /**
     * Mapping of Arabic letters to their isolated, final, initial, and medial forms.
     *
     * @var array<string, array<int, string>>
     */
    protected const FORMS = [
        'ء' => ['ء', 'ء', 'ء', 'ء'],
        'آ' => ['آ', 'آ', 'آ', 'آ'],
        'أ' => ['ﺃ', 'ﺄ', 'ﺃ', 'ﺄ'],
        'ؤ' => ['ﺅ', 'ﺆ', 'ﺅ', 'ﺆ'],
        'إ' => ['ﺇ', 'ﺈ', 'ﺇ', 'ﺈ'],
        'ئ' => ['ﺉ', 'ﺊ', 'ﺋ', 'ﺌ'],
        'ا' => ['ﺍ', 'ﺎ', 'ﺍ', 'ﺎ'],
        'ب' => ['ﺏ', 'ﺐ', 'ﺑ', 'ﺒ'],
        'ة' => ['ﺓ', 'ﺔ', 'ﺓ', 'ﺔ'],
        'ت' => ['ﺕ', 'ﺖ', 'ﺗ', 'ﺘ'],
        'ث' => ['ﺙ', 'ﺚ', 'ﺛ', 'ﺜ'],
        'ج' => ['ﺝ', 'ﺞ', 'ﺟ', 'ﺠ'],
        'ح' => ['ﺡ', 'ﺢ', 'ﺣ', 'ﺤ'],
        'خ' => ['ﺥ', 'ﺦ', 'ﺧ', 'ﺨ'],
        'د' => ['ﺩ', 'ﺪ', 'ﺩ', 'ﺪ'],
        'ذ' => ['ﺫ', 'ﺬ', 'ﺫ', 'ﺬ'],
        'ر' => ['ﺭ', 'ﺮ', 'ﺭ', 'ﺮ'],
        'ز' => ['ﺯ', 'ﺰ', 'ﺯ', 'ﺰ'],
        'س' => ['ﺱ', 'ﺲ', 'ﺳ', 'ﺴ'],
        'ش' => ['ﺵ', 'ﺶ', 'ﺷ', 'ﺸ'],
        'ص' => ['ﺹ', 'ﺺ', 'ﺻ', 'ﺼ'],
        'ض' => ['ﺽ', 'ﺾ', 'ﺿ', 'ﺿ'],
        'ط' => ['ﻁ', 'ﻂ', 'ﻁ', 'ﻂ'],
        'ظ' => ['ﻅ', 'ﻆ', 'ﻇ', 'ﻆ'],
        'ع' => ['ﻉ', 'ﻊ', 'ﻋ', 'ﻌ'],
        'غ' => ['ﻍ', 'ﻎ', 'ﻏ', 'ﻐ'],
        'ف' => ['ﻑ', 'ﻒ', 'ﻓ', 'ﻔ'],
        'ق' => ['ﻕ', 'ﻖ', 'ﻗ', 'ﻘ'],
        'ك' => ['ﻙ', 'ﻚ', 'ﻛ', 'ﻜ'],
        'ل' => ['ﻝ', 'ﻞ', 'ﻟ', 'ﻠ'],
        'م' => ['ﻡ', 'ﻢ', 'ﻣ', 'ﻤ'],
        'ن' => ['ﻥ', 'ﻦ', 'ﻧ', 'ﻨ'],
        'ه' => ['ﻩ', 'ﻪ', 'ﻫ', 'ﻬ'],
        'و' => ['ﻭ', 'ﻮ', 'ﻭ', 'ﻮ'],
        'ى' => ['ﻯ', 'ﻰ', 'ﻯ', 'ﻰ'],
        'ي' => ['ﻱ', 'ﻲ', 'ﻳ', 'ﻴ'],
        'ﻻ' => ['ﻻ', 'ﻼ', 'ﻻ', 'ﻼ'],
        'ﻷ' => ['ﻷ', 'ﻸ', 'ﻷ', 'ﻸ'],
        'ﻹ' => ['ﻹ', 'ﻺ', 'ﻹ', 'ﻺ'],
        'ﻵ' => ['ﻵ', 'ﻶ', 'ﻵ', 'ﻶ'],
    ];

    /**
     * Letters that do not connect to the following letter.
     *
     * @var array<int, string>
     */
    protected const NON_CONNECTING_AFTER = ['ا', 'أ', 'إ', 'آ', 'د', 'ذ', 'ر', 'ز', 'و', 'ؤ', 'ء', 'ة', 'ى', 'ﻻ', 'ﻷ', 'ﻹ', 'ﻵ'];

    /**
     * Letters that do not connect to the previous letter.
     *
     * @var array<int, string>
     */
    protected const NON_CONNECTING_BEFORE = ['ء'];

    /**
     * Convert Arabic text into presentation forms that GD can render properly.
     */
    public static function shape(string $text): string
    {
        if ($text === '' || !preg_match('/\p{Arabic}/u', $text)) {
            return $text;
        }

        $text = self::applyLigatures($text);
        $chars = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY) ?: [];
        $count = count($chars);
        $shaped = [];

        for ($i = 0; $i < $count; $i++) {
            $char = $chars[$i];

            if (!isset(self::FORMS[$char])) {
                $shaped[] = $char;
                continue;
            }

            $prevIndex = self::findPreviousIndex($chars, $i);
            $nextIndex = self::findNextIndex($chars, $i);

            $connectsWithPrev = false;
            if ($prevIndex !== null) {
                $prevChar = $chars[$prevIndex];
                $connectsWithPrev = isset(self::FORMS[$prevChar])
                    && !in_array($prevChar, self::NON_CONNECTING_AFTER, true)
                    && !in_array($char, self::NON_CONNECTING_BEFORE, true);
            }

            $connectsWithNext = false;
            if ($nextIndex !== null) {
                $nextChar = $chars[$nextIndex];
                $connectsWithNext = isset(self::FORMS[$nextChar])
                    && !in_array($char, self::NON_CONNECTING_AFTER, true)
                    && !in_array($nextChar, self::NON_CONNECTING_BEFORE, true);
            }

            if ($connectsWithPrev && $connectsWithNext) {
                $shaped[] = self::FORMS[$char][3]; // medial
            } elseif ($connectsWithPrev) {
                $shaped[] = self::FORMS[$char][1]; // final
            } elseif ($connectsWithNext) {
                $shaped[] = self::FORMS[$char][2]; // initial
            } else {
                $shaped[] = self::FORMS[$char][0]; // isolated
            }
        }

        return implode('', $shaped);
    }

    protected static function applyLigatures(string $text): string
    {
        $replacements = [
            'لأ' => 'ﻷ',
            'لإ' => 'ﻹ',
            'لآ' => 'ﻵ',
            'لا' => 'ﻻ',
        ];

        return str_replace(array_keys($replacements), array_values($replacements), $text);
    }

    protected static function findPreviousIndex(array $chars, int $current): ?int
    {
        for ($i = $current - 1; $i >= 0; $i--) {
            if (isset(self::FORMS[$chars[$i]])) {
                return $i;
            }
        }

        return null;
    }

    protected static function findNextIndex(array $chars, int $current): ?int
    {
        $count = count($chars);
        for ($i = $current + 1; $i < $count; $i++) {
            if (isset(self::FORMS[$chars[$i]])) {
                return $i;
            }
        }

        return null;
    }
}
