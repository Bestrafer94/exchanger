<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\TransactionsNotFoundException;
use App\Handler\Command\TransactionsListCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TransactionsListController extends BaseController
{
    /**
     * @Route("/transactions", name="transactions")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function list(Request $request): Response
    {
        try {
            $command = new TransactionsListCommand($request->query->getInt('page', 1));
            $transactions = $this->commandBus->handle($command);
            $parameters = [
                'transactions' => $transactions,
            ];
        } catch (TransactionsNotFoundException $exception) {
            $parameters = [
                'errorMessage' => $exception->getMessage(),
                'statusCode' => Response::HTTP_NOT_FOUND,
            ];
        }

        return $this->render('transactions_list.html.twig', $parameters);
    }
}
