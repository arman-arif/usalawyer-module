<?php

namespace App\Modules\Lawyer\Database\Seeders;

use App\Modules\Lawyer\Models\Category;
use App\Modules\Lawyer\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Criminal Law' => [
                'DUI Defense',
                'Drug Charges',
                'Assault & Battery',
                'Theft & Fraud',
                'White Collar Crime',
                'Juvenile Defense',
            ],
            'Family Law' => [
                'Divorce',
                'Child Custody',
                'Child Support',
                'Adoption',
                'Prenuptial Agreements',
                'Domestic Violence',
            ],
            'Personal Injury' => [
                'Car Accidents',
                'Truck Accidents',
                'Slip & Fall',
                'Medical Malpractice',
                'Workplace Injury',
                'Wrongful Death',
            ],
            'Estate Planning' => [
                'Wills',
                'Trusts',
                'Probate',
                'Power of Attorney',
                'Elder Law',
            ],
            'Business Law' => [
                'Business Formation',
                'Contracts',
                'Mergers & Acquisitions',
                'Intellectual Property',
                'Business Disputes',
            ],
            'Real Estate Law' => [
                'Residential Purchase & Sale',
                'Commercial Real Estate',
                'Landlord-Tenant',
                'Zoning & Land Use',
                'Title Disputes',
            ],
            'Immigration Law' => [
                'Visas',
                'Green Cards',
                'Citizenship',
                'Deportation Defense',
                'Asylum',
            ],
            'Employment Law' => [
                'Discrimination',
                'Wage & Hour',
                'Harassment',
                'Wrongful Termination',
                'Workers Compensation',
            ],
            'Bankruptcy' => [
                'Chapter 7',
                'Chapter 13',
                'Debt Settlement',
                'Foreclosure Defense',
            ],
            'Tax Law' => [
                'Tax Planning',
                'IRS Disputes',
                'Tax Litigation',
                'Estate & Gift Tax',
            ],
        ];

        foreach ($data as $categoryName => $subCategoryNames) {
            $category = Category::updateOrCreate(
                ['slug' => Str::slug($categoryName)],
                ['name' => $categoryName]
            );

            foreach ($subCategoryNames as $subName) {
                SubCategory::upsert([
                        'category_id' => $category->id,
                        'slug' => Str::slug($subName),
                        'name' => $subName
                ], ['category_id', 'slug']);
            }
        }
    }
}
