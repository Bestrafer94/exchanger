<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\Type\TransactionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExchangeController extends AbstractController
{
    /**
     * @Route("/", name="exchange")
     */
    public function exchange(): Response
    {
        return $this->render(
            'exchanger.html.twig',
            [
                'exchangeForm' => $this->createForm(TransactionType::class)->createView(),
            ]
        );
    }
}
