<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigMainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('config_main')->insert([
            'id' => 1
        ]);

        DB::table('config_main_translation')->insert([
            [
                'logo' => '/assets/frontend/images/logo.svg',
                'name' => 'Esearch phiên bản beta 1.0',
                'company_name' => 'Công ty TNHH ARIS Việt Nam',
                'slogan' => '
                Giáo dục là quyền con người với sức mạnh to lớn để biến đổi. Trên nền tảng của nó, phần còn lại là nền tảng của tự do, dân chủ và phát triển con người bền vững.',
                'quote' => '- Công ty Vietlabo -',
                'address' => 'Tòa nhà Waseco, Số 10 Phổ Quang, phường 2, quận Tân Bình, TPHCM.',
                'phone' => '(+84) 28 38424483',
                'email' => 'contact@aris-vn.com',
                'represent' => 'Trần Tuấn Nhật',
                'num_client' => 8,
                'num_school' => 8,
                'num_promo' => 6,
                'distance_google' => 20,
                'background_search' => '#33b9ff,#a1ffd6',
                'background_promotion' => '#f173ac,#472f92',
                'background_client' => '#8dc63f,#00c7cf',
                'enable_ssl' => 0,
                'meta_title' => 'Nội dung meta title',
                'meta_keyword' => 'Nội dung meta keyword',
                'meta_description' => 'Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một văn bản chuẩn cho ngành công nghiệp in ấn từ những năm 1500, khi một họa sĩ vô danh ghép nhiều đoạn văn bản với nhau để tạo thành một bản mẫu văn bản. Đoạn văn bản này không những đã tồn tại năm thế kỉ, mà khi được áp dụng vào tin học văn phòng, nội dung của nó vẫn không hề bị thay đổi. Nó đã được phổ biến trong những năm 1960 nhờ việc bán những bản giấy Letraset in những đoạn Lorem Ipsum, và gần đây hơn, được sử dụng trong các ứng dụng dàn trang, như Aldus PageMaker. Trái với quan điểm chung của số đông, Lorem Ipsum không phải chỉ là một đoạn văn bản ngẫu nhiên. Người ta tìm thấy nguồn gốc của nó từ những tác phẩm văn học la-tinh cổ điển xuất hiện từ năm 45 trước Công Nguyên, nghĩa là nó đã có khoảng hơn 2000 tuổi. Một giáo sư của trường Hampden-Sydney College (bang Virginia - Mỹ) quan tâm tới một trong những từ la-tinh khó hiểu nhất, "consectetur", trích từ một đoạn của Lorem Ipsum, và đã nghiên cứu tất cả các ứng dụng của từ này trong văn học cổ điển, để từ đó tìm ra nguồn gốc không thể chối cãi của Lorem Ipsum. Thật ra, nó được tìm thấy trong các đoạn 1.10.32 và 1.10.33 của "De Finibus Bonorum et Malorum" (Đỉnh tối thượng của Cái Tốt và Cái Xấu) viết bởi Cicero vào năm 45 trước Công Nguyên. Cuốn sách này là một luận thuyết đạo lí rất phổ biến trong thời kì Phục Hưng. Dòng đầu tiên của Lorem Ipsum, "Lorem ipsum dolor sit amet..." được trích từ một câu trong đoạn thứ 1.10.32.',
                'analytics_id' => null,
                'facebook_page' => 'https://www.facebook.com/ARISVNVIETNAM/',
                'googleplus_page' => null,
                'language_id' => 1,
                'translation_id' => 1
            ],
            [
                'logo' => '/assets/frontend/images/logo.svg',
                'name' => 'Esearch beta version 1.0',
                'company_name' => 'ARIS VIETNAM CO., LTD',
                'slogan' => 'Education is a human right with immense power to transform. On its foundation rest the cornerstones of freedom, democracy and sustainable human development.',
                'quote' => '- Vietlabo Company -',
                'address' => 'Waseco building, 10 Pho Quang, ward 2, district Tan Binh, HCMC, Vietnam',
                'phone' => '(+84) 28 38424483',
                'email' => 'contact@aris-vn.com',
                'represent' => 'Trần Tuấn Nhật',
                'num_client' => 8,
                'num_school' => 8,
                'num_promo' => 6,
                'distance_google' => 20,
                'background_search' => '#33b9ff,#a1ffd6',
                'background_promotion' => '#f173ac,#472f92',
                'background_client' => '#8dc63f,#00c7cf',
                'enable_ssl' => 0,
                'meta_title' => 'Nội dung meta title tiếng anh',
                'meta_keyword' => 'Nội dung meta keyword tiếng anh',
                'meta_description' => 'Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một văn bản chuẩn cho ngành công nghiệp in ấn từ những năm 1500, khi một họa sĩ vô danh ghép nhiều đoạn văn bản với nhau để tạo thành một bản mẫu văn bản. Đoạn văn bản này không những đã tồn tại năm thế kỉ, mà khi được áp dụng vào tin học văn phòng, nội dung của nó vẫn không hề bị thay đổi. Nó đã được phổ biến trong những năm 1960 nhờ việc bán những bản giấy Letraset in những đoạn Lorem Ipsum, và gần đây hơn, được sử dụng trong các ứng dụng dàn trang, như Aldus PageMaker. Trái với quan điểm chung của số đông, Lorem Ipsum không phải chỉ là một đoạn văn bản ngẫu nhiên. Người ta tìm thấy nguồn gốc của nó từ những tác phẩm văn học la-tinh cổ điển xuất hiện từ năm 45 trước Công Nguyên, nghĩa là nó đã có khoảng hơn 2000 tuổi. Một giáo sư của trường Hampden-Sydney College (bang Virginia - Mỹ) quan tâm tới một trong những từ la-tinh khó hiểu nhất, "consectetur", trích từ một đoạn của Lorem Ipsum, và đã nghiên cứu tất cả các ứng dụng của từ này trong văn học cổ điển, để từ đó tìm ra nguồn gốc không thể chối cãi của Lorem Ipsum. Thật ra, nó được tìm thấy trong các đoạn 1.10.32 và 1.10.33 của "De Finibus Bonorum et Malorum" (Đỉnh tối thượng của Cái Tốt và Cái Xấu) viết bởi Cicero vào năm 45 trước Công Nguyên. Cuốn sách này là một luận thuyết đạo lí rất phổ biến trong thời kì Phục Hưng. Dòng đầu tiên của Lorem Ipsum, "Lorem ipsum dolor sit amet..." được trích từ một câu trong đoạn thứ 1.10.32. tiếng anh',
                'analytics_id' => null,
                'facebook_page' => 'https://www.facebook.com/ARISVNVIETNAM/',
                'googleplus_page' => null,
                'language_id' => 2,
                'translation_id' => 1
            ]
        ]);

        DB::table('config_other')->insert([
            [
                'key' => 'FB_APP_ID',
                'value' => '353801758354249',
            ],
            [
                'key' => 'FB_APP_KEY',
                'value' => '14665b763284484a4401a096e39f890b',
            ],
            [
                'key' => 'FB_APP_CALLBACK',
                'value' => 'https://demo.aris-vn.com:8085/callback/facebook',
            ],
            [
                'key' => 'GG_APP_ID',
                'value' => '439513774126-kjf0duufqmj8pcg6g79bcrorthd3ejte.apps.googleusercontent.com',
            ],
            [
                'key' => 'GG_APP_KEY',
                'value' => 'vtkI_wwNZPS0NE5py4V5DLqB',
            ],
            [
                'key' => 'GG_APP_CALLBACK',
                'value' => 'https://demo.aris-vn.com:8085/callback/google',
            ],
            [
                'key' => 'GG_KEY_MAP',
                'value' => 'AIzaSyCgckjWdlD5EvdCSb68pDxkxWeiUHFqKtc',
            ]
        ]);

        DB::table('config_email')->insert([
            [
                'smtp_server' => 'smtp.gmail.com',
                'smtp_port' => '465',
                'smtp_username' => 'demo@gmail.com',
                'smtp_password' => '123456',
                'smtp_protocol' => 'TLS',
                'smtp_name' => 'Demo Sender',
                'default' => 1,
                'default_credentials' => 1,
            ],
            [
                'smtp_server' => 'smtp.gmail.com',
                'smtp_port' => '465',
                'smtp_username' => 'demo1@gmail.com',
                'smtp_password' => '123456',
                'smtp_protocol' => 'TLS',
                'smtp_name' => 'Demo Sender 1',
                'default' => 0,
                'default_credentials' => 0,
            ],
            [
                'smtp_server' => 'smtp.gmail.com',
                'smtp_port' => '465',
                'smtp_username' => 'demo2@gmail.com',
                'smtp_password' => '123456',
                'smtp_protocol' => 'TLS',
                'smtp_name' => 'Demo Sender 2',
                'default' => 0,
                'default_credentials' => 0,
            ]

        ]);

    }
}
