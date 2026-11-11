<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class LiveBlogSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement("UPDATE posts SET created_at = datetime('2026-06-01 10:00:00', '-' || id || ' hours'), updated_at = created_at");

        $targetPosts = [
            [
                'title' => 'Acid Dyes Explained for Silk, Wool, and Nylon',
                'slug' => 'acid-dyes-for-silk-wool-and-nylon',
                'image_url' => '/uploads/2026/10/2148883207.jpg',
                'excerpt' => 'Acid dyes are extensively used in textile processing for producing bright shades, controlled colour build-up and colour performance depending upon application on compatible fibres. They',
                'date' => '2026-10-27 10:00:00'
            ],
            [
                'title' => 'Acid Dyes Vs Reactive Dyes: Which Is More Better',
                'slug' => 'acid-dyes-vs-reactive-dyes',
                'image_url' => '/uploads/2026/10/2148016404.jpg',
                'excerpt' => 'The selection of textile dye is important to obtain uniform colours, dependable fastness and the preferred look of the finished fabrics. Acid Dyes and Reactive',
                'date' => '2026-10-26 15:00:00'
            ],
            [
                'title' => 'Disperse Dyes Vs Reactive Dye: Know the Difference',
                'slug' => 'disperse-dyes-vs-reactive-dyes',
                'image_url' => '/uploads/2026/10/2147964097.jpg',
                'excerpt' => 'The selection of the appropriate textile dye is crucial to ensure efficient production, uniform colours, and reliable fabric performance. Disperse dyes and reactive dyes are',
                'date' => '2026-10-26 14:00:00'
            ],
            [
                'title' => 'Types of Disperse Dyes and Their Uses',
                'slug' => 'types-of-disperse-dyes-and-their-uses',
                'image_url' => '/uploads/2026/10/2148016489.jpg',
                'excerpt' => 'Good dyeing solutions are essential for the textile industry to achieve consistent colours, attractive finishes, and reliable performance of fabrics. Amongst the different textile colourants,',
                'date' => '2026-10-26 10:00:00'
            ],
            [
                'title' => 'Different Types of Vat Dyes​ and Their Uses',
                'slug' => 'different-types-of-vat-dyes-and-their-uses',
                'image_url' => '/uploads/2026/09/An-Introduction-to-Vat-Dyes-for-Deep-Vibrant-Colors-1.jpg',
                'excerpt' => 'Introduction Textile manufacturers, dyeing units, garment producers and industrial buyers dealing with cotton and other appropriate cellulosic fibres need to be aware of the different',
                'date' => '2026-09-29 16:00:00'
            ],
            [
                'title' => 'What Is a Vat-Dyed Pool Towel?',
                'slug' => 'what-is-a-vat-dyed-pool-towel',
                'image_url' => '/uploads/2026/09/4035.jpg',
                'excerpt' => 'Introduction: A Vat-Dyed Pool Towel is normally a towel, most commonly made of suitable cotton or other cellulosic fibres, which has been dyed with Vat',
                'date' => '2026-09-29 14:00:00'
            ],
            [
                'title' => 'Is Eosin an Acidic Dye?',
                'slug' => 'is-eosin-an-acidic-dye',
                'image_url' => '/uploads/2026/09/37577.jpg',
                'excerpt' => 'Introduction Is Eosin an Acidic Dye? Yes. Eosin is usually an acidic, negatively charged dye and is well-known for its role as a counterstain in',
                'date' => '2026-09-29 12:00:00'
            ],
            [
                'title' => 'Why Do Acidic Dyes Leave Bacterial Cells Unstained?',
                'slug' => 'why-do-acidic-dyes-leave-bacterial-cells-unstained',
                'image_url' => '/uploads/2026/09/4121.jpg',
                'excerpt' => 'The interaction of dyes with diverse materials is significant in textile processing, laboratory applications and microbiology. The question often asked is why do the acidic',
                'date' => '2026-09-29 10:00:00'
            ],
            [
                'title' => 'Are Reactive Dyes Eco Friendly?',
                'slug' => 'reactive-dyes',
                'image_url' => '/uploads/2026/08/Are-Reactive-Dyes-Eco-Friendly.png',
                'excerpt' => 'Introduction Reactive Dyes – Are They Eco-friendly? The answer is not only yes or no. Reactive Dyes can offer significant performance advantages in textile applications,',
                'date' => '2026-08-21 14:00:00'
            ],
            [
                'title' => 'What is Reactive Dye and Its Process?',
                'slug' => 'what-is-reactive-dye-and-its-process',
                'image_url' => '/uploads/2026/08/2148734276.jpg',
                'excerpt' => 'Introduction What is Reactive Dye & Its Process? Reactive Dyes are a class of textile dyes formulated to form a chemical bond with suitable fiber',
                'date' => '2026-08-21 10:00:00'
            ],
        ];

        foreach ($targetPosts as $pData) {
            $post = Post::where('title', 'like', '%' . trim(explode(':', $pData['title'])[0]) . '%')
                        ->orWhere('slug', $pData['slug'])
                        ->first();
            if (!$post) {
                $post = new Post();
            }
            $post->title = $pData['title'];
            $post->slug = $pData['slug'];
            $post->image_url = $pData['image_url'];
            $post->excerpt = $pData['excerpt'];
            $post->created_at = $pData['date'];
            $post->updated_at = $pData['date'];
            $post->save();
        }
    }
}

