<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Transaction;
use App\Exception\TransactionNotFoundException;
use App\Form\Type\TargetCurrencyChangeType;
use App\Handler\Command\TransactionDetailsCommand;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TransactionDetailsController extends BaseController
{
    /**
     * @Route("/transaction/{id}", methods={"GET"}, name="transaction_details")
     *
     * @param int $id
     *
     * @return Response
     */
    public function details(int $id): Response
    {
        $command = new TransactionDetailsCommand($id);

        try {
            $transaction = $this->commandBus->handle($command);
            $parameters = [
                'transaction' => $transaction,
                'targetCurrencyChangeForm' => $this->createForm(TargetCurrencyChangeType::class)->createView(),
            ];
        } catch (TransactionNotFoundException $exception) {
            $parameters = [
                'errorMessage' => $exception->getMessage(),
                'statusCode' => Response::HTTP_NOT_FOUND,
            ];
        }

        return $this->render(
            'transaction_details.html.twig',
            $parameters
        );
    }
}
