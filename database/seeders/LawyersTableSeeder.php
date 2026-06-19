<?php

namespace App\Modules\Lawyer\Database\Seeders;

use App\Modules\Lawyer\Models\Category;
use App\Modules\Lawyer\Models\Lawyer;
use App\Modules\Lawyer\Models\Location;
use App\Modules\Lawyer\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LawyersTableSeeder extends Seeder
{
    public function run(): void
    {
        $locations = Location::pluck('id', 'name');
        $categories = Category::pluck('id', 'name');
        $subCategories = SubCategory::pluck('id', 'name');

        $lawyers = [
            [
                'name' => 'Sarah Mitchell',
                'email' => 'sarah.mitchell@example.com',
                'contact_number' => '+1-512-555-0101',
                'address' => '500 W 2nd St, Austin, TX 78701',
                'about_overview' => 'Former prosecutor with 15 years defending clients against criminal charges across Texas.',
                'practice_areas' => ['Criminal Defense', 'Trial Advocacy', 'Negotiation'],
                'is_paid' => true,
                'website_url' => 'https://mitchell-law.example.com',
                'featured_date_setup' => now()->addMonths(3),
                'categories' => ['Criminal Law'],
                'sub_categories' => ['DUI Defense', 'Drug Charges'],
                'locations' => ['Texas', 'California'],
            ],
            [
                'name' => 'James O\'Brien',
                'email' => 'james.obrien@example.com',
                'contact_number' => '+1-212-555-0102',
                'address' => '350 5th Ave, New York, NY 10118',
                'about_overview' => 'Compassionate family law attorney focused on amicable resolutions and child-first outcomes.',
                'practice_areas' => ['Family Law', 'Mediation', 'Litigation'],
                'is_paid' => true,
                'website_url' => 'https://obrien-family.example.com',
                'featured_date_setup' => now()->addMonths(6),
                'categories' => ['Family Law'],
                'sub_categories' => ['Divorce', 'Child Custody'],
                'locations' => ['New York', 'Florida'],
            ],
            [
                'name' => 'Patricia Reyes',
                'email' => 'patricia.reyes@example.com',
                'contact_number' => '+1-312-555-0103',
                'address' => '233 S Wacker Dr, Chicago, IL 60606',
                'about_overview' => 'Aggressive personal injury advocate with $50M+ recovered for injured clients.',
                'practice_areas' => ['Personal Injury', 'Medical Malpractice', 'Wrongful Death'],
                'is_paid' => true,
                'website_url' => 'https://reyes-injury.example.com',
                'featured_date_setup' => now()->addYear(),
                'categories' => ['Personal Injury'],
                'sub_categories' => ['Car Accidents', 'Medical Malpractice'],
                'locations' => ['Illinois', 'Pennsylvania'],
            ],
            [
                'name' => 'Michael Chen',
                'email' => 'michael.chen@example.com',
                'contact_number' => '+1-206-555-0104',
                'address' => '1201 3rd Ave, Seattle, WA 98101',
                'about_overview' => 'Estate planning attorney helping families preserve wealth across generations.',
                'practice_areas' => ['Estate Planning', 'Tax Planning', 'Trusts'],
                'is_paid' => false,
                'website_url' => 'https://chen-estate.example.com',
                'featured_date_setup' => null,
                'categories' => ['Estate Planning'],
                'sub_categories' => ['Wills', 'Trusts'],
                'locations' => ['Washington', 'Oregon'],
            ],
            [
                'name' => 'David Thompson',
                'email' => 'david.thompson@example.com',
                'contact_number' => '+1-415-555-0105',
                'address' => '555 California St, San Francisco, CA 94104',
                'about_overview' => 'Silicon Valley business lawyer specializing in startups and IP protection.',
                'practice_areas' => ['Business Law', 'Intellectual Property', 'Startups'],
                'is_paid' => true,
                'website_url' => 'https://thompson-biz.example.com',
                'featured_date_setup' => now()->addMonths(2),
                'categories' => ['Business Law'],
                'sub_categories' => ['Business Formation', 'Intellectual Property'],
                'locations' => ['California', 'Nevada'],
            ],
            [
                'name' => 'Linda Garcia',
                'email' => 'linda.garcia@example.com',
                'contact_number' => '+1-602-555-0106',
                'address' => '100 N Central Ave, Phoenix, AZ 85004',
                'about_overview' => 'Real estate transactions and zoning expert serving Arizona developers.',
                'practice_areas' => ['Real Estate', 'Zoning', 'Land Use'],
                'is_paid' => false,
                'website_url' => 'https://garcia-realty.example.com',
                'featured_date_setup' => null,
                'categories' => ['Real Estate Law'],
                'sub_categories' => ['Commercial Real Estate', 'Zoning & Land Use'],
                'locations' => ['Arizona', 'Texas'],
            ],
            [
                'name' => 'Robert Williams',
                'email' => 'robert.williams@example.com',
                'contact_number' => '+1-646-555-0107',
                'address' => '1 World Trade Ctr, New York, NY 10007',
                'about_overview' => 'Bilingual immigration attorney guiding families through the legal process.',
                'practice_areas' => ['Immigration', 'Asylum', 'Citizenship'],
                'is_paid' => true,
                'website_url' => 'https://williams-immigration.example.com',
                'featured_date_setup' => now()->addMonths(4),
                'categories' => ['Immigration Law'],
                'sub_categories' => ['Visas', 'Asylum'],
                'locations' => ['New York', 'New Jersey'],
            ],
            [
                'name' => 'Karen Davis',
                'email' => 'karen.davis@example.com',
                'contact_number' => '+1-617-555-0108',
                'address' => '100 Federal St, Boston, MA 02110',
                'about_overview' => 'Employment law advocate for workers facing discrimination and wage theft.',
                'practice_areas' => ['Employment Law', 'Civil Rights', 'Litigation'],
                'is_paid' => true,
                'website_url' => 'https://davis-employment.example.com',
                'featured_date_setup' => now()->addMonths(5),
                'categories' => ['Employment Law'],
                'sub_categories' => ['Discrimination', 'Wage & Hour'],
                'locations' => ['Massachusetts', 'Connecticut'],
            ],
            [
                'name' => 'Thomas Mueller',
                'email' => 'thomas.mueller@example.com',
                'contact_number' => '+1-216-555-0109',
                'address' => '200 Public Sq, Cleveland, OH 44114',
                'about_overview' => 'Bankruptcy counsel providing fresh financial starts for individuals and small businesses.',
                'practice_areas' => ['Bankruptcy', 'Debt Relief', 'Financial Restructuring'],
                'is_paid' => false,
                'website_url' => 'https://mueller-bankruptcy.example.com',
                'featured_date_setup' => null,
                'categories' => ['Bankruptcy'],
                'sub_categories' => ['Chapter 7', 'Chapter 13'],
                'locations' => ['Ohio', 'Michigan'],
            ],
            [
                'name' => 'Angela Foster',
                'email' => 'angela.foster@example.com',
                'contact_number' => '+1-404-555-0110',
                'address' => '191 Peachtree St NE, Atlanta, GA 30303',
                'about_overview' => 'Tax attorney resolving IRS disputes and structuring complex transactions.',
                'practice_areas' => ['Tax Law', 'IRS Controversy', 'Corporate Tax'],
                'is_paid' => true,
                'website_url' => 'https://foster-tax.example.com',
                'featured_date_setup' => now()->addMonths(8),
                'categories' => ['Tax Law'],
                'sub_categories' => ['Tax Planning', 'IRS Disputes'],
                'locations' => ['Georgia', 'Florida'],
            ],
            [
                'name' => 'Christopher Park',
                'email' => 'christopher.park@example.com',
                'contact_number' => '+1-303-555-0111',
                'address' => '1700 Lincoln St, Denver, CO 80203',
                'about_overview' => 'Trucking accident specialist with deep knowledge of FMCSA regulations.',
                'practice_areas' => ['Personal Injury', 'Trucking Accidents', 'Insurance Disputes'],
                'is_paid' => true,
                'website_url' => 'https://park-injury.example.com',
                'featured_date_setup' => now()->addMonths(7),
                'categories' => ['Personal Injury'],
                'sub_categories' => ['Truck Accidents', 'Wrongful Death'],
                'locations' => ['Colorado', 'Utah'],
            ],
            [
                'name' => 'Maria Santos',
                'email' => 'maria.santos@example.com',
                'contact_number' => '+1-213-555-0112',
                'address' => '633 W 5th St, Los Angeles, CA 90071',
                'about_overview' => 'Family law attorney specializing in adoption and prenuptial agreements.',
                'practice_areas' => ['Family Law', 'Adoption', 'Prenuptial Agreements'],
                'is_paid' => false,
                'website_url' => 'https://santos-family.example.com',
                'featured_date_setup' => null,
                'categories' => ['Family Law'],
                'sub_categories' => ['Adoption', 'Prenuptial Agreements'],
                'locations' => ['California', 'Texas'],
            ],
        ];

        foreach ($lawyers as $row) {
            $lawyer = Lawyer::updateOrCreate(
                ['email' => $row['email']],
                [
                    'name' => $row['name'],
                    'contact_number' => $row['contact_number'],
                    'address' => $row['address'],
                    'about_overview' => $row['about_overview'],
                    'practice_areas' => $row['practice_areas'],
                    'is_paid' => $row['is_paid'],
                    'website_url' => $row['website_url'],
                    'featured_date_setup' => $row['featured_date_setup'],
                ]
            );

            $lawyer->categories()->sync(
                collect($row['categories'])->map(fn($n) => $categories[$n] ?? null)->filter()->values()->all()
            );
            $lawyer->subCategories()->sync(
                collect($row['sub_categories'])->map(fn($n) => $subCategories[$n] ?? null)->filter()->values()->all()
            );
            $lawyer->locations()->sync(
                collect($row['locations'])->map(fn($n) => $locations[$n] ?? null)->filter()->values()->all()
            );
        }
    }
}
