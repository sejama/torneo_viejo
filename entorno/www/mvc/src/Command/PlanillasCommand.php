<?php 

namespace App\Command;

use App\Repository\PartidoRepository;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


#[AsCommand(
    name: 'app:crear-planillas',
    description: 'Creador de planillas',
    hidden: false,
    aliases: ['app:crear-planillas']
)]
class PlanillasCommand extends Command
{
    public function __construct(
        private PartidoRepository $partidoRepository
    )
    {
        parent::__construct();
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $partidos = $this->partidoRepository->findAll();

        foreach ($partidos as $partido) {
            $output->writeln($partido->getId() . ' - ' . $partido->getEquipoLocal()->getNombre() . ' vs ' . $partido->getEquipoVisitante()->getNombre());


            $result = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data('https://torneo.sejama.com.ar/partido/'. $partido->getId() .'/editar')
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(ErrorCorrectionLevel::High)
            ->size(300)
            ->margin(10)
            ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
            ->logoPath(__DIR__.'/assets/nuevo.png')
            ->logoResizeToWidth(75)
            ->logoPunchoutBackground(true)
            ->labelText('Partido '. $partido->getId(). ' - ' .$partido->getEquipoLocal()->getNombre() . ' vs ' . $partido->getEquipoVisitante()->getNombre())
            ->labelFont(new NotoSans(10))
            ->labelAlignment(LabelAlignment::Center)
            ->validateResult(false)
            ->build();

            // Save it to a file
            $result->saveToFile(__DIR__.'/assets/qr/partido-'. $partido->getId() .'.png');
        }
        return Command::SUCCESS;

        
        // return Command::FAILURE;

        
        // return Command::INVALID
    }

    protected function configure(): void
    {
        $this
            // the command description shown when running "php bin/console list"
            ->setDescription('Creador de planillas')
            // the command help shown when running the command with the "--help" option
            ->setHelp('Este comando permite crear planillas de partidos.')
            ->addArgument('csv', InputArgument::REQUIRED, 'Ruta donde se encuentra el archivo CSV con los partidos a crear.')
        ;
    }
}