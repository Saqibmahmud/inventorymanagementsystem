<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $location
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branches newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branches newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branches query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branches whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branches whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branches whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branches whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Branches whereUpdatedAt($value)
 */
	class Branches extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $brand_name
 * @property string $brand_code
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Products> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brands newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brands newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brands query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brands whereBrandCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brands whereBrandName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brands whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brands whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brands whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brands whereUpdatedAt($value)
 */
	class Brands extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $customer_name
 * @property string $customer_email
 * @property string $customer_phone
 * @property int $branch_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sales> $Sales
 * @property-read int|null $sales_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereCustomerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereCustomerPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereUpdatedAt($value)
 */
	class Customer extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $product_category_name
 * @property string $product_category_code
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Products> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product_Categories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product_Categories newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product_Categories query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product_Categories whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product_Categories whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product_Categories whereProductCategoryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product_Categories whereProductCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product_Categories whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product_Categories whereUpdatedAt($value)
 */
	class Product_Categories extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $supplier_id
 * @property string $product_name
 * @property string $sku
 * @property int $brands_id
 * @property int $product_categories_id
 * @property string $description
 * @property string|null $price
 * @property int $stock_quantity
 * @property int $reorder_level
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $branch_id
 * @property-read \App\Models\Brands|null $brands
 * @property-read \App\Models\Product_Categories|null $product_categories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Purchases_Items> $purchases_item
 * @property-read int|null $purchases_item_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sales_item> $sales_item
 * @property-read int|null $sales_item_count
 * @property-read \App\Models\Supplier|null $supplier
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereBrandsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereProductCategoriesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereReorderLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereStockQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Products whereUpdatedAt($value)
 */
	class Products extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $supplier_id
 * @property string $purchase_date
 * @property string $total_amount
 * @property string $status
 * @property string $paid_with
 * @property int $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $branch_id
 * @property-read \App\Models\Branches|null $branches
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Purchases_Items> $purchase_items
 * @property-read int|null $purchase_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Stock_Transactions> $stock_transactions
 * @property-read int|null $stock_transactions_count
 * @property-read \App\Models\Supplier|null $supplier
 * @property-read \App\Models\User|null $updated_user
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases wherePaidWith($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases wherePurchaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases whereUpdatedBy($value)
 */
	class Purchases extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $purchase_id
 * @property int $product_id
 * @property int $quantity
 * @property string $purchase_price
 * @property string $total_price
 * @property int $received_quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Products|null $product
 * @property-read \App\Models\Purchases|null $purchase
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases_Items newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases_Items newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases_Items query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases_Items whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases_Items whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases_Items whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases_Items wherePurchaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases_Items wherePurchasePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases_Items whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases_Items whereReceivedQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases_Items whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchases_Items whereUpdatedAt($value)
 */
	class Purchases_Items extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $customer_id
 * @property string $sale_date
 * @property string $total_amount
 * @property int $status
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $branch_id
 * @property-read \App\Models\Customer|null $Customer
 * @property-read \App\Models\Sales_item|null $Sales_item
 * @property-read \App\Models\User|null $User
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Stock_Transactions> $stock_transactions
 * @property-read int|null $stock_transactions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sales newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sales newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sales query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sales whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sales whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sales whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sales whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sales whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sales whereSaleDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sales whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sales whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sales whereUpdatedAt($value)
 */
	class Sales extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $sale_id
 * @property int $product_id
 * @property int $quantity
 * @property string $selling_price
 * @property string $total_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Sales_item> $sale
 * @property-read int|null $sale_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sales_item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sales_item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sales_item query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sales_item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sales_item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sales_item whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sales_item whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sales_item whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sales_item whereSellingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sales_item whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sales_item whereUpdatedAt($value)
 */
	class Sales_item extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $product_id
 * @property string $transaction_type
 * @property int $quantity
 * @property string $transaction_date
 * @property int $reference_id
 * @property string|null $reference_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $branch_id
 * @property-read \App\Models\Products|null $products
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $reference
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock_Transactions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock_Transactions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock_Transactions query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock_Transactions whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock_Transactions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock_Transactions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock_Transactions whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock_Transactions whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock_Transactions whereReferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock_Transactions whereReferenceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock_Transactions whereTransactionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock_Transactions whereTransactionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Stock_Transactions whereUpdatedAt($value)
 */
	class Stock_Transactions extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $supplier_name
 * @property string|null $contact_name
 * @property string $email
 * @property string $phone
 * @property string|null $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Products> $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Purchases> $purchases
 * @property-read int|null $purchases_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereSupplierName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereUpdatedAt($value)
 */
	class Supplier extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $branch_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sales> $Sales
 * @property-read int|null $sales_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, $guard = null)
 */
	class User extends \Eloquent {}
}

