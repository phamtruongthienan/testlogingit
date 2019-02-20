<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlugTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_slug')->insert([
            ['slug' => 'press/ve-chung-toi', 'category' => 'm_news'],
            ['slug' => 'press/about-us', 'category' => 'm_news'],
            ['slug' => 'press/lien-he', 'category' => 'm_news'],
            ['slug' => 'press/contact', 'category' => 'm_news'],

            ['slug' => 'school/truong-thpt-tan-binh-post-1', 'category' => 'm_school'],
            ['slug' => 'school/tan-binh-high-school-post-1', 'category' => 'm_school'],
            ['slug' => 'school/truong-dai-hoc-kinh-te-tphcm-post-2', 'category' => 'm_school'],
            ['slug' => 'school/university-of-economics-ho-chi-minh-post-2', 'category' => 'm_school'],

            ['slug' => 'school/truong-dai-hoc-tai-chinh-marketing-post-3', 'category' => 'm_school'],
            ['slug' => 'school/university-of-finance-marketing-post-3', 'category' => 'm_school'],
            ['slug' => 'school/truong-dai-hoc-quoc-te-sai-gon-post-4', 'category' => 'm_school'],
            ['slug' => 'school/saigon-international-university-post-4', 'category' => 'm_school'],
        ]);
        for($i=1;$i<=5; $i++) {
            DB::table('m_rating')->insert( ['rating' => $i]);
        }

        DB::table('m_rating_translation')->insert([
            ['name' => 'Không hài lòng', 'language_id' => 1, 'translation_id' => 1],
            ['name' => 'Unsatisfied', 'language_id' => 2, 'translation_id' => 1],

            ['name' => 'Tốt', 'language_id' => 1, 'translation_id' => 2],
            ['name' => 'Good', 'language_id' => 2, 'translation_id' => 2],

            ['name' => 'Rất tốt', 'language_id' => 1, 'translation_id' => 3],
            ['name' => 'Very good', 'language_id' => 2, 'translation_id' => 3],

            ['name' => 'Xuất sắc', 'language_id' => 1, 'translation_id' => 4],
            ['name' => 'Excellent', 'language_id' => 2, 'translation_id' => 4],

            ['name' => 'Trên cả tuyệt vời', 'language_id' => 1, 'translation_id' => 5],
            ['name' => 'Exceptional', 'language_id' => 2, 'translation_id' => 5],
        ]);

        DB::table('m_genitive')->insert([
            [
                'id' => 1,
                'genitive' => 'ngoan ngoãn'
            ],
            [
                'id' => 2,
                'genitive' => 'hiền lành'
            ],
            [
                'id' => 3,
                'genitive' => 'chăm chỉ'
            ],
            [
                'id' => 4,
                'genitive' => 'dễ thương'
            ],
            [
                'id' => 5,
                'genitive' => 'nghịch ngợm'
            ],
            [
                'id' => 6,
                'genitive' => 'quậy phá'
            ],
            [
                'id' => 7,
                'genitive' => 'cute'
            ],
            [
                'id' => 8,
                'genitive' => 'phô mai que'
            ],
        ]);

        DB::table('m_school_score')->insert([
            [
                'school_id' => 1,
                'score' => rand(1,10)
            ],
            [
                'school_id' => 2,
                'score' => rand(1,10)
            ],
            [
                'school_id' => 3,
                'score' => rand(1,10)
            ],
            [
                'school_id' => 4,
                'score' => rand(1,10)
            ]
        ]);
        DB::table('m_school_comment_rating')->insert([
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ],
            [
                'customer_id' => rand(1,99),
                'category_id' => rand(1,4),
                'school_id' => rand(1,4),
                'rating' => rand(1, 10)
            ]
           ]
        );

        DB::table('m_exchange_rate')->insert([
            ['language_id' => 2, 'rate' => '23280']
        ]);

        DB::table('m_keyword_search')->insert([
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)],
            ['keyword' => str_random(3).' '.str_random(3), 'language_id' => rand(1,2)]
        ]);
    }
}
