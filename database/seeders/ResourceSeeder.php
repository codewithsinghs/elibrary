<?php

namespace Database\Seeders;


use App\Models\Resource;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Resource::factory()->count(10)->create();
        $resources = [
            [
                'name' => 'Shodh Ganga',
                'slug' => Str::slug('Shodh Ganga'),
                'caption' => 'A reservoir of Indian Theses.',
                'description' => 'The Shodhganga@INFLIBNET Centre provides a platform for research students to deposit their Ph.D. theses and make it available to the entire scholarly community in open access.',
                'url' => 'https://shodhganga.inflibnet.ac.in/',
                'category' => 'Research References',
                'author' => 'Shodh Ganga',
                'published_at' => '2021-01-01',
                'image' => 'laravel_docs.jpg',
            ],
            [
                'name' => 'OATD',
                'slug' => Str::slug('OATD'),
                'caption' => 'Open Access Theses and Dissertations.',
                'description' => 'Advanced research and scholarship. Theses and dissertations, free to find, free to use..',
                'url' => 'https://shodhganga.inflibnet.ac.in/',
                'category' => 'Documentation',
                'author' => 'Taylor Otwell',
                'published_at' => '2021-01-01',
                'image' => 'laravel_docs.jpg',
            ],
            [
                'name' => 'NDLTD',
                'slug' => Str::slug('NDLTD'),
                'caption' => 'Global ETD Search.',
                'description' => 'Search the 6,481,602 electronic theses and dissertations contained in the NDLTD archive.',
                'url' => 'http://search.ndltd.org/',
                'category' => 'Research References',
                'author' => 'NDLTD',
                'published_at' => '2021-01-01',
                'image' => 'laravel_docs.jpg',
            ],
            [
                'name' => 'IEEE',
                'slug' => Str::slug('IEEE'),
                'caption' => 'Advancing Technology for Humanity.',
                'description' => 'IEEE Xplore is the flagship digital platform for discovery and access to scientific and technical content published by the IEEE (Institute of Electrical and Electronics Engineers) and its publishing partners.',
                'url' => 'https://ieeexplore.ieee.org/Xplore/home.jsp/',
                'category' => 'E Journals',
                'author' => 'IEEE',
                'published_at' => '2020-01-01',
                'image' => 'laravel_docs.jpg',
            ],
            [
                'name' => 'Sage Journals',
                'slug' => Str::slug('Sage Open Access'),
                'caption' => 'A reservoir of Indian Theses.',
                'description' => 'Sage empowers researchers, librarians and readers through: Gold and Green Open Access publishing options Open access agreements, Author support and information.',
                'url' => 'https://journals.sagepub.com/',
                'category' => 'E Journals',
                'author' => 'Sage Open Access',
                'published_at' => '2019-01-01',
                'image' => 'laravel_docs.jpg',
            ],
            [
                'name' => 'South Asia Commons',
                'slug' => Str::slug('South Asia Commons'),
                'caption' => 'It’s the largest collection of books, journals and documents.',
                'description' => 'Subjects across a broad range are covered, including archaeology, industry, parliamentary debates and concerns, and law case reports.',
                'url' => 'https://southasiacommons.net/?from=www.SARF/',
                'category' => 'E Books',
                'author' => 'South Asian Research Foundation',
                'published_at' => '2021-01-01',
                'image' => 'laravel_docs.jpg',
            ],
            [
                'name' => 'National Digital library',
                'slug' => Str::slug('National Digital library'),
                'caption' => 'One Library All of India',
                'description' => 'National Digital Library of India (NDLI) is a virtual repository of learning resources which is not just a repository with search/browse facilities but provides a host of services for the learner community.',
                'url' => 'https://ndl.iitkgp.ac.in/',
                'category' => 'Open Acces Library',
                'author' => 'National Digital library',
                'published_at' => '2021-01-01',
                'image' => 'laravel_docs.jpg',
            ],
            [
                'name' => 'Digital Commons Network',
                'slug' => Str::slug('Digital Commons Network'),
                'caption' => 'Curated by university librarians and their supporting institutions.',
                'description' => 'The Digital Commons Network brings together free, full-text scholarly articles from hundreds of universities and colleges worldwide.',
                'url' => 'https://network.bepress.com/',
                'category' => 'Open Acces Library',
                'author' => 'Shodh Ganga',
                'published_at' => '2021-01-01',
                'image' => 'laravel_docs.jpg',
            ],
            [
                'name' => 'Open Library',
                'slug' => Str::slug('Open Library'),
                'caption' => 'Open Library is an initiative of the Internet Archive.',
                'description' => 'Open Library is an open, editable library catalog, building towards a web page for every book ever published.',
                'url' => 'https://openlibrary.org/',
                'category' => 'Open Acces Library',
                'author' => 'Open Acces Library',
                'published_at' => '2015-01-01',
                'image' => 'laravel_docs.jpg',
            ],
            [
                'name' => 'Ugc Care',
                'slug' => Str::slug('Ugc Care'),
                'caption' => 'UGC-CARE- A Quality Mandate for Indian Academia.',
                'description' => 'To match global standards of high quality research, in all academic disciplines under its purview, the University Grants Commission (UGC) aspires to stimulate and empower the Indian academia through its “Quality Mandate”',
                'url' => 'https://ugccare.unipune.ac.in/apps1/home/index',
                'category' => 'Important Links',
                'author' => 'UGC',
                'published_at' => '2018-11-28',
                'image' => 'laravel_docs.jpg',
            ],

            [
                'name' => 'Online E News paper',
                'slug' => Str::slug('Online E News paper'),
                'caption' => 'Indian Newspapers : English Newspapers in India.',
                'description' => 'A list of Indian newspapers in English and links to the pages of non-English language news media in India.',
                'url' => 'https://www.w3newspapers.com/india/',
                'category' => 'E News',
                'author' => 'E News',
                'published_at' => '2018-11-28',
                'image' => 'laravel_docs.jpg',
            ],
            // Add 8 more resources here...
        ];

        foreach ($resources as $resource) {
            Resource::create($resource);
        }
    }
}
