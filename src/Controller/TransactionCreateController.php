<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Transaction;
use App\Exception\ExchangeRatesNotFetchedException;
use App\Exception\SameCurrenciesException;
use App\Form\Data\TransactionData;
use App\Form\Type\TransactionType;
use App\Handler\Command\TransactionCreateCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TransactionCreateController extends BaseController
{
    /**
     * @Route("/transaction", name="transaction_create")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(Request $request): Response
    {
        $form = $this->createForm(TransactionType::class, new TransactionData());

        if ($this->isFormValidAndSubmitted($form, $request)) {
            try {
                $command = new TransactionCreateCommand($form->getData(), $request->getClientIp());

                /** @var Transaction $transaction */
                $transaction = $this->commandBus->handle($command);
                $parameters = [
                    'transaction' => $transaction,
                    'statusCode' => Response::HTTP_CREATED,
                ];
            } catch (ExchangeRatesNotFetchedException $exception) {
                $parameters = [
                    'errorMessage' => $exception->getMessage(),
                    'statusCode' => Response::HTTP_FAILED_DEPENDENCY,
                ];
            } catch (SameCurrenciesException $exception) {
                $parameters = [
                    'errorMessage' => $exception->getMessage(),
                    'statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY,
                ];
            }
        } else {
            $parameters = [
                'validationMessages' => $this->getErrorsFromForm($form),
                'statusCode' => Response::HTTP_BAD_REQUEST,
            ];
        }

        return $this->render(
            'transaction_created.html.twig',
            array_merge($parameters, ['action' => 'created'])
        );
    }
}
