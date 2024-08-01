<?php

namespace TroskiShop\Infrastructure\Domain\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use TroskiShop\Application\DTOs\Products\ProductsFilterDto;
use TroskiShop\Domain\Model\Product;
use TroskiShop\Domain\Repository\ProductRepositoryInterface;
use Doctrine\ORM\QueryBuilder;

class DoctrineProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    const ENTITY_ALIAS = 'PRODUCT';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }
    public function listProductsFromProductFilter(ProductsFilterDto $productsFilterDto): array
    {
        $queryBuilder = $this->createQueryBuilder('p');
        $this->configureFiltersInQueryBuilderFromProductsFilter($queryBuilder, $productsFilterDto);
        return $queryBuilder->getQuery()->getResult();

    }

    public function findByUri(string $uri): Product
    {
        return $this->findOneBy(['uri' => $uri]);
    }

    public function countAllBrands(): array
    {
        return $this->createQueryBuilder('p')
                ->select('p.brand as brand','COUNT(p.brand) as count')
                ->groupBy('p.brand')
                ->getQuery()->getArrayResult();
    }

    public function countAllCategories(): array
    {
        return $this->createQueryBuilder('p')
                ->select('p.category as category','COUNT(p.category) as count')
                ->groupBy('p.category')
                ->getQuery()->getArrayResult();
    }

    private function configureFiltersInQueryBuilderFromProductsFilter(QueryBuilder $queryBuilder, ProductsFilterDto $productsFilterDto): void
    {
        $queryBuilder->where('p.active = :active')
            ->setParameter('active', $productsFilterDto->isActive());

        if(!empty($productsFilterDto->getNameProduct())) {
            $queryBuilder->andWhere('p.name LIKE :nameProduct')
                ->setParameter('nameProduct', '%'.$productsFilterDto->getNameProduct().'%');
        }

        if(!empty($productsFilterDto->getCategory())) {
            $queryBuilder->andWhere('p.category = :category')
                ->setParameter('category', $productsFilterDto->getCategory());
        }

        if(!empty($productsFilterDto->getBrand())) {
            $queryBuilder->andWhere('p.brand = :brand')
                ->setParameter('brand', $productsFilterDto->getBrand());
        }

        if(!empty($productsFilterDto->getPriceMin())) {
            $queryBuilder->andWhere('p.price >= :priceMin')
                ->setParameter('priceMin', $productsFilterDto->getPriceMin());
        }

        if(!empty($productsFilterDto->getPriceMax())) {
            $queryBuilder->andWhere('p.price <= :priceMax')
                ->setParameter('priceMax', $productsFilterDto->getPriceMax());
        }

        if(!empty($productsFilterDto->getLastProductId())) {
            $queryBuilder->andWhere('p.id < :lastProductId')
                ->setParameter('lastProductId', $productsFilterDto->getLastProductId());
        }

        $queryBuilder->setMaxResults(20)
            ->orderBy('p.id', 'DESC');
    }
}